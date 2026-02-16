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


class LoginPassword extends BaseComponent
{
    public $phone;
    public $password;
    public $recaptcha;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
    }

    public function mount()
    {
        session(['url.intended' => url()->previous()]);
    }

    public function render()
    {
        return view('new.auth.password')->extends('new.auth.layouts.master');
    }

    private function resetInputs()
    {
        $this->reset(['phone', 'password']);
    }


    public function signUp()
    {

        $this->validate([
            'phone' => ['required', 'string', 'size:11'],
            'password' => ['required', 'string']
        ], [], [
            'phone' => 'شماره همراه',
            'password' => 'رمز عبور',
        ]);


        $user = User::where('phone', $this->phone)->first();

        if (!$user) {
            $this->addError('phone', 'اطلاعات وارد شده صحیح نیست');
            $this->addError('password', 'اطلاعات وارد شده صحیح نیست');
        } else {
            if (Hash::check($this->password, $user->password)) {
                \Illuminate\Support\Facades\Auth::loginUsingId($user->id, true);
                $this->emitNotify('با موفقیت وارد شدید');
                redirect()->intended(route('home'));
            }else{
                $this->addError('phone', 'اطلاعات وارد شده صحیح نیست');
                $this->addError('password', 'اطلاعات وارد شده صحیح نیست');
            }


        }

    }
}
