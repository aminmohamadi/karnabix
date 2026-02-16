

<section class="col-lg-4">

        <div class="auth-form shadow-xl rounded  mt-5 bg-white p-5">
            <div class="auth-form-title mb-4 slider-title-desc-center">
                <h2 class="text-center h4 text-muted title-font">ورود به پنل کاربری</h2>
            </div>
            <form wire:submit.prevent="signUp()" id="login-with-code-form">

                <div class="form-group">
                    <label for="phone" class="label-text">شماره همراه</label>
                    <input id="phone" wire:model.defer="phone" class="form-control form--control" type="text" name="name"
                           placeholder="شماره همراه">
                    @error('phone')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror

                </div>
                <div class="form-group">
                    <label for="password" class="label-text">رمز عبور</label>
                    <input id="password" wire:model.defer="password" class="form-control form--control" type="password" name="password"
                           placeholder="شماره همراه">
                    @error('password')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror

                </div>

                {{--            <div class="input-box mt-4">--}}
                {{--                <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}"--}}
                {{--                     data-callback="reCaptchaCallback" wire:ignore></div>--}}
                {{--                @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror--}}
                {{--            </div>--}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 mt-4 btn-login">
                        ورود
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{route('login-otp')}}" class="btn btn-outline-info w-100 mt-4 btn-login">
                        ورود با پیامک
                    </a>
                </div>
                <div class="form-group">
                    <a href="{{ route('registerNew') }}" class="btn btn-outline-success w-100 mt-4 btn-login">
                        عضویت
                    </a>
                </div>
            </form>

            <div class="form-group mt-3">
                <a href="" class="btn main-color-two-bg btn-login w-100"
                   style="border-color: transparent">
                </a>
            </div>
            <div class="form-group mt-3">
                <a href="" class="btn main-color-two-bg btn-login w-100"
                   style="border-color: transparent">
                </a>
            </div>
        </div>




</section>
<script>
    window.addEventListener('otp-phase-loaded', function () {
        countdown('countdownB', 0, 0, 0, 120);
        if (typeof initOtp === 'function') initOtp();


    });
</script>
