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
use function PHPUnit\Framework\isNull;


class LoginOtp extends BaseComponent
{
    public $phone;
    public $recaptcha;
    public $auth_type;
    public $ok = false;
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

    }

    public function render()
    {
        return view('site.auth.login-otp')->extends('site.auth.auth');
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
        $w = OneTimeCode::where('user_id', $user->id)->delete();

        $this->emitNotify('با موفقیت وارد شدید');
        try {
            AuthenticationEvent::dispatch($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->intended(route('home'));

    }

    private function resetInputs()
    {
        $this->reset(['phone']);
    }

    public function sendVerificationCode($property = 'phone', $action = 'login'): bool|MessageBag
    {

        $userRepository = $this->userRepository;
        $user = User::where('phone', $this->{$property})->first();

        if (!$user) {
            return $this->addError("$property", 'شماره موبایل اشتباه است');

        }
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
            'phone' => ['required', 'string', 'size:11'],
        ], [], [
            'phone' => 'شماره همراه',
        ]);

        $this->sendVerificationCode();

    }


}
