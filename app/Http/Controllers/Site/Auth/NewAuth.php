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


class NewAuth extends BaseComponent
{
    protected $queryString = ['ref'];
    public $phone, $password, $name, $action = self::MODE_LOGIN, $email, $ref_code, $login_method;
    public $logo, $authImage, $passwordLabel = 'رمز عبور';
    public $step = 1;
    public $recaptcha;
    public $verify_code;
    public $ref;

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
        $title = 'ثبت نام';

        $this->logo = $this->settingRepository->getRow('logo');
        $this->authImage = $this->settingRepository->getRow('authImage');
        SEOMeta::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword', []));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->auth_type = $this->settingRepository->getRow('auth_type') ?? 'none';
        $this->ref_code = request()->get('referral_code');
    }

    public function render()
    {
        return view('new.auth.auth')->extends('new.auth.layouts.master');
    }

    private function resetInputs()
    {
        $this->reset(['phone',]);
    }


    public function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make(Session::get('timer')));
        return ((int)$interval->format("%r%s") > 0);
    }

    public function setTimer()
    {
        $this->emit('timer', ['data' => Session::get('timer') ? Session::get('timer')->toDateTimeString() : '']);
    }

    public function checkSession()
    {
        if ($this->checkTimer()) {
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

    public function skip_ref()
    {
        $this->step = 3;
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

    public function signUp()
    {

        $this->validate([
            'phone' => ['required', 'string', 'size:11'],
        ], [], [
            'phone' => 'شماره همراه',
        ]);

        $this->sendVerificationCode();

    }

    public function sendVerificationCode($property = 'phone'): bool|MessageBag
    {

        $userRepository = $this->userRepository;
        $user = User::where('phone', $this->phone)->first();


        if ($user) {
            $this->step = 3;
            $this->sendOTP($property, $user);
        } else {
            $user = $userRepository->create([
                'phone' => $this->phone,
                'status' => 'not_confirmed',
                'referral_code' => $this->generateUniqueReferralCode()
            ]);
            $this->step = 2;
            $this->sendOTP($property, $user);
        }

        return false;
    }

    private function sendOTP($property, $user)
    {
        $this->resetErrorBag();
        try {
            PasswordResetLinkController::sendCode($user);

            $this->dispatchBrowserEvent('otp-phase-loaded');
        } catch (\Exception $e) {
            $this->addError("$property", 'خطا در هنگام ارسال رمز');
        }
    }

    public function login()
    {
        $this->resetErrorBag();
        $this->validate([
            'phone' => ['required', 'string', 'exists:users,phone'],
            'verify_code' => ['required', 'max:240', 'string'],
        ], [], [
            'phone' => 'شماره',
            'verify_code' => 'رمز عبور',
        ]);

        $user = User::where('phone', $this->phone)->first();

        $time = Carbon::now()->subMinutes(15);
        $this->validate([
            'verify_code' => [
                'required',
                Rule::exists('one_time_codes', 'code')->where(function ($query) use ($user, $time) {
                    $query->where('user_id', $user->id)->where('created_at', '>=', $time);
                }),
            ]
        ], [
            'verify_code.exists' => 'کد وارد شده اشتباه است'
        ]);
        $user->status = 'confirmed';
        $user->save();
        \Illuminate\Support\Facades\Auth::loginUsingId($user->id, true);
        OneTimeCode::where('user_id', $user->id)->delete();

        $this->emitNotify('با موفقیت وارد شدید');
        try {
            AuthenticationEvent::dispatch($user);
        } catch (\Exception $e) {
            $this->addError("user_id", 'خطا در هنگام ارسال رمز');
        }
        return redirect()->route('home');

    }


    public function referral()
    {
        $this->validate([
            'ref' => ['nullable', Rule::exists('users', 'referral_code')]
        ], [], [
            'ref' => 'کد معرف',
        ]);
        $referrer = User::all()->where('referral_code', $this->ref)->first();
        $user = User::where('phone', $this->phone)->first();
        $user->referrer_id = $referrer->id ?? null;
        $user->save();
        $this->step = 3;
    }
}
