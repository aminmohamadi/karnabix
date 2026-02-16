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


class Register extends BaseComponent
{
    public $phone;
    public $recaptcha;
    public $ok = false;
    public $referral;
    public $verify_code;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
    }

    public function mount()
    {
       $this->referral = request()->get('referral_code');
        session(['url.intended' => url()->previous()]);
    }

    public function render()
    {
        return view('site.auth.registerNew')->extends('site.auth.auth');
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
        $auth = false;
        $x = $this->validate([
            'verify_code' => [
                'required',
                Rule::exists('one_time_codes', 'code')->where(function ($query) use ($user, $time) {
                    $query->where('user_id', $user->id)->where('created_at', '>=', $time);
                }),
            ]
        ], [
            'verify_code.exists' => 'کد وارد شده اشتباه است'
        ]);
        \Illuminate\Support\Facades\Auth::loginUsingId($user->id, true);
        $user->status = "confirmed";
        $user->save();
        $w = OneTimeCode::where('user_id', $user->id)->delete();

        $this->emitNotify('با موفقیت وارد شدید');
        try {
            AuthenticationEvent::dispatch($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->intended(route('home'));
//        if (Hash::check($this->password, $user->password)){
//            $auth = true;
//            $this->emitNotify('با موفقیت وارد شدید');
//            redirect()->intended(route('home'));

    }

    private function resetInputs()
    {
        $this->reset(['phone', 'referral']);
    }

    public function sendVerificationCode($property = 'phone', $action = 'login'): bool|MessageBag
    {

        $userRepository = $this->userRepository;
//
//        if (rateLimiter(value:$this->{$property}."_{$action}_code",max_tries: 5))
//        {
//            $this->resetInputs();
//            return
//                $this->addError("$property", 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
//        }

        $referrer = User::all()->where('referral_code', $this->referral)->first();


        $user = $userRepository->create([
            'phone' => $this->{$property},
            'referral_code' => $this->generateUniqueReferralCode(),
            'referrer_id' => $referrer->id ?? null,
            'ip' => request()->ip(),
        ]);
        $this->sendOTP($property, $user);

        return false;

    }

    private function sendOTP($property, $user)
    {
        $this->resetErrorBag();
        try {
            PasswordResetLinkController::sendCode($user);
            $this->ok = true;
            $this->dispatchBrowserEvent('otp-phase-loaded');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError("$property", 'خطا در هنگام ارسال رمز');
        }
    }

    public function signUp()
    {

        $this->validate([
            'phone' => ['required', 'string', 'size:11','unique:users,phone'],
            'referral' => ['nullable', Rule::exists('users', 'referral_code')]
        ], [], [
            'phone' => 'شماره همراه',
            'referral' => 'کد معرف',
        ]);

        $this->sendVerificationCode();

    }

    function generateUniqueReferralCode($length = 6)
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
