<section class="col-lg-4">
    @if(!$ok)
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

                            <div class="input-box mt-4">
                                <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                     data-callback="reCaptchaCallback" wire:ignore></div>
                                @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 mt-4 btn-login">
                        ورود
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{route('login-password')}}" class="btn btn-outline-info w-100 mt-4 btn-login">
                        ورود با رمز عبور
                    </a>
                </div>
                <div class="form-group">
                    <a href="{{ route('registerNew') }}" class="btn btn-outline-success w-100 mt-4 btn-login">
                        عضویت
                    </a>
                </div>
            </form>


        </div>
    @elseif($ok)
        <div class="auth-form shadow-xl rounded  mt-5 bg-white p-5">
            <div class="alert text-center alert-success">
                یک کد برای شما پیامک شد لطفا آن را وارد کنید
            </div>
            <form id="one-time-login-form" wire:submit.prevent="login()">
                <div id="otp-input">
                    <input placeholder="_" type="number" step="1" min="0" max="9" autocomplete="no"
                           pattern="\d*"/>
                    <input placeholder="_" type="number" step="1" min="0" max="9" autocomplete="no"
                           pattern="\d*"/>
                    <input placeholder="_" type="number" step="1" min="0" max="9" autocomplete="no"
                           pattern="\d*"/>
                    <input placeholder="_" type="number" step="1" min="0" max="9" autocomplete="no"
                           pattern="\d*"/>
                    <input placeholder="_" type="number" step="1" min="0" max="9" autocomplete="no"
                           pattern="\d*"/>
                    <input id="otp-value" placeholder="_" type="hidden" name="verify_code" wire:model="verify_code"/>
                </div>
                @error('verify_code')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror


                <div class="countDownContainer" style="display: flex; justify-content: center; direction: ltr" wire:ignore>
                    <div class="countdown-bar" id="countdownB">
                        <div></div>
                        <div></div>
                    </div>
                </div>


                <div class="form-group mt-3">
                    <button type="submit" id="submit" class="btn btn-primary w-100 mt-4 btn-login">
                        وورد به
                        سایت
                    </button>
                </div>

            </form>
        </div>

    @endif



</section>
<script>
    window.addEventListener('otp-phase-loaded', function () {
        countdown('countdownB', 0, 0, 0, 120);
        if (typeof initOtp === 'function') initOtp();


    });
</script>
