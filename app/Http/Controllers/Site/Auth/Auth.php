<?php

namespace App\Http\Controllers\Site\Auth;

use App\Enums\NotificationEnum;
use App\Enums\UserEnum;
use App\Events\AuthenticationEvent;
use App\Events\RegisterEvent;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Models\OneTimeCode;
use App\Models\User;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseComponent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth as Authentication;
use App\Mail\AuthenticationMail as AuthMailer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class Auth extends BaseComponent
{
    protected $queryString = ['action'];
    public $phone , $password  , $name  , $action = self::MODE_LOGIN , $email , $ref_code , $login_method;
    public $logo , $authImage , $passwordLabel = 'رمز عبور';
    public bool $sms = false , $sent = false;

    public $recaptcha;
    public $forget_phone;

    public $auth_type;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
        $this->login_method = "password";
    }

    public function mount()
    {
        if (!isset($this->action))
            $this->action = self::MODE_LOGIN;

        if ($this->action == self::MODE_LOGIN) $title = 'ورود';
        else $title = 'ثبت نام';

        $this->logo = $this->settingRepository->getRow('logo');
        $this->authImage = $this->settingRepository->getRow('authImage');
        SEOMeta::setTitle($this->settingRepository->getRow('title').' '.$title);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' '.$title);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' '.$title);
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').' '.$title);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->auth_type = $this->settingRepository->getRow('auth_type') ?? 'none';
        $this->ref_code = request()->get('referral_code');
    }

    public function render()
    {
        if ($this->action == self::MODE_LOGIN) return view('site.auth.login')->extends('site.layouts.site.site');
        else return view('site.auth.register')->extends('site.layouts.site.site');
    }

    public function login()
    {
//        if ($rateKey = rateLimiter(value:$this->phone.'_login',max_tries: 5))
//        {
//            $this->resetInputs();
//            return
//                $this->addError('phone', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
//        }
        $this->resetErrorBag();
        $this->validate([
            'phone' => ['required','string','exists:users,phone'],
            'password' => ['required','max:240','string'],
//            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'phone' => 'شماره',
            'password' => 'رمز عبور',
            'recaptcha' => 'فیلد امنیتی'
        ]);
        $user = User::where('phone', $this->phone)->first();
        $time = Carbon::now()->subMinutes(15);
        $auth = false;
        $confirm_user = false;

        if ($this->login_method == "otp") {
            $this->validate([
                'password' => [
                    'required',
                    Rule::exists('one_time_codes', 'code')->where(function ($query) use ($user, $time) {
                        $query->where('user_id', $user->id)->where('created_at', '>=', $time);
                    }),
                ]
            ], [
                'verify_code.exists' => 'کد وارد شده اشتباه است'
            ]);


            \Illuminate\Support\Facades\Auth::loginUsingId($user->id, true);
            OneTimeCode::where('user_id', $user->id)->delete();
            $this->emitNotify('با موفقیت وارد شدید');
           return redirect()->intended(route('home'));

        }elseif($this->login_method == "password"){
            if (Hash::check($this->password, $user->password)){
                $auth = true;
                $this->emitNotify('با موفقیت وارد شدید');
                redirect()->intended(route('home'));
            }else{
                return $this->addError('password','رمزعبور یا شماره وارد شده اشتباه می باشد');
            }

        }



        if ($auth) {

            Authentication::login($user,true);
            request()->session()->regenerate();
            $this->userRepository->update($user,['otp' => null]);
//            RateLimiter::clear($rateKey);
            try {
                AuthenticationEvent::dispatch($user);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            if ($confirm_user)
                $this->userRepository->update($user,['status' => UserEnum::CONFIRMED]);

            redirect()->intended(route('home'));
        }
        return $this->addError('password','گذواژه یا شماره همراه اشتباه می باشد.');
    }

    private function resetInputs()
    {
        $this->reset(['phone', 'password','forget_phone']);
    }

    public function sendVerificationCode($property = 'phone' , $action = 'login'): bool|MessageBag
    {
        $this->login_method = "otp";
        $userRepository =  $this->userRepository;
        if ($this->sent && $this->checkTimer())
            return $this->addError($property,'رمز یکبار مصرف قبلا برای شما ارسال شده است.');

//        if (rateLimiter(value:$this->{$property}."_{$action}_code",max_tries: 5))
//        {
//            $this->resetInputs();
//            return
//                $this->addError("$property", 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
//        }

        $this->validate([
            "$property" => ['required','string','exists:users,phone'],
        ],[],[
            "$property" => 'شماره همراه ',
        ]);

        $rand = $this->generateCode();
        $user = $userRepository->getUser('phone',$this->{$property});
//        app(OtpRepositoryInterface::class)->save($user,$rand);

        $this->sendOTP($property,$user,$rand,$action);
        return false;
    }

    private function sendOTP($property,$user,$code , $action)
    {
        $this->resetErrorBag();
        $sendRepository =  $this->sendRepository;

        $ok = false;
        try {
            if ($this->auth_type == NotificationEnum::SMS_METHOD){
                PasswordResetLinkController::sendCode($user);
                $this->passwordLabel = 'رمز ارسال شده را وارد نماید';
                $ok = true;
            } elseif ($this->auth_type == NotificationEnum::EMAIL_METHOD) {
                $sendRepository->sendEmail(new AuthMailer($user,$code),$user->email);
                $this->passwordLabel = 'رمز ایمیل شده را وارد نماید';
                $ok = true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError("$property",'خطا در هنگام ارسال رمز');
        }

        if ($ok) {
            Session::put('timer', Carbon::make(now())->addSeconds(90));
            $this->setTimer();
            $this->sms = true;
            $this->sent = true;
        }
    }

    public function signUp()
    {
        $this->sent = false;
        $this->validate([
            'name' => ['required','string','max:250'],
            'email' => ['string','email','unique:users,email','max:250'],
            'phone' => ['required','string','size:11','unique:users,phone'],
            'password' => ['required','min:'.($this->settingRepository->getRow('password_length') ?? 8),'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'name' => 'نام کامل',
            'email' => 'ایمیل',
            'phone' => 'شماره همراه',
            'password' => 'رمز عبور',
            'recaptcha' => 'فیلد امنیتی'
        ]);
        $referrer = User::all()->where('referral_code',$this->ref_code)->first();
        $user = $this->userRepository->create([
            'name' => $this->name,
//            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'status' => UserEnum::NOT_CONFIRMED,
            'referral_code'=>$this->generateUniqueReferralCode(),
            'referrer_id'=>$referrer->id ?? null,
            'ip' => request()->ip(),

        ]);
        $registerGift = $this->settingRepository->getRow('registerGift');
        if (!empty($registerGift) && is_numeric($registerGift) &&  $registerGift> 0)
            $user->deposit($this->settingRepository->getRow('registerGift'), ['description' => 'هدیه ثبت نام', 'from_admin'=> true]);

        $this->sendVerificationCode();

        try {
            RegisterEvent::dispatch($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        redirect()->route('auth');
    }

    public function generateCode(): int
    {
        return mt_rand(12345,999998);
    }

    public function canSendAgain()
    {
        $this->sent = false;
    }

    public function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make(Session::get('timer')));
        return ((int)$interval->format("%r%s") > 0);
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => Session::get('timer') ? Session::get('timer')->toDateTimeString() : '' ]);
    }

    public function checkSession()
    {
        if ($this->checkTimer())
        {
            $this->sent = true;
            $this->setTimer();
        }
    }

    function generateUniqueReferralCode($length = 6)
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }


    public function store()
    {
        $this->validate([
            'phone' => 'required|exists:users,phone',
        ], [
            'phone.exists' => 'حساب کاربری با شماره موبایل ' . $this->phone . ' وجود ندارد. لطفا ثبت نام کنید'
        ]);

        $user = User::where('phone', $this->phone)->first();
        PasswordResetLinkController::sendCode($user);

        return response('success');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,username',
        ]);

        $user = User::where('phone', $request->mobile)->first();
        $time = Carbon::now()->subMinutes(15);

        $request->validate([
            'verify_code'     => [
                'required',
                Rule::exists('one_time_codes', 'code')->where(function ($query) use ($user, $time) {
                    $query->where('user_id', $user->id)->where('created_at', '>=', $time);
                }),
            ]
        ], [
            'verify_code.exists' => 'کد وارد شده اشتباه است'
        ]);

        \Illuminate\Support\Facades\Auth::loginUsingId($user->id, true);
        OneTimeCode::where('user_id', $user->id)->delete();

        return response('success');
    }
}
