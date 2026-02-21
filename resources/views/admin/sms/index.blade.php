<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <section class="users-edit">
                <div class="card">
                    <div id="main-card" class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <form id="sms-form" wire:submit.prevent="store()">
                                    <h4 class="my-2">تنظیمات پنل پیامک</h4>

                                    <div class="sms-panel-fields" id="ippannel-sms-fields">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>نام کاربری</label>
                                                <div class="input-group mb-75">
                                                    <input type="text"
                                                           wire:model="smsPanelUsername"
                                                           class="form-control ltr">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>رمز عبور</label>
                                                <div class="input-group mb-75">
                                                    <input type="text" wire:model="smsPanelPassword"
                                                           class="form-control ltr">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>شماره ارسالی</label>
                                                <div class="input-group mb-75">
                                                    <input type="text" wire:model="smsPanelFrom"
                                                           class="form-control ltr">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row my-2 mb-4">
                                        <div class="form-group col-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input data-class="sms_to_verify_user" type="checkbox"
                                                           wire:model="userVerifyPatternEnabled">
                                                    <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">تایید کاربر با شماره همراه</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input data-class="sms_on_user_register" type="checkbox"
                                                           wire:model="afterExamPaidSmsEnabled">
                                                    <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">ارسال پیامک بعد از خرید آزمون</span>
                                                </div>
                                            </fieldset>
                                        </div>


                                        <div class="form-group col-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input data-class="sms_on_user_register" type="checkbox"
                                                           wire:model="afterExamRejectedSmsEnabled">
                                                    <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">ارسال پیامک بعد از رد شدن آزمون</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input data-class="sms_on_user_register" type="checkbox"
                                                           wire:model="userWalletBalanceIncreasedSmsEnabled">
                                                    <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">ارسال پیامک بعد افزایش موجودی</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input data-class="sms_on_user_register" type="checkbox"
                                                           wire:model="userWalletBalanceDecreasedSmsEnabled">
                                                    <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">ارسال پیامک بعد افزایش موجودی</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if($userVerifyPatternEnabled)
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 form-group mb-0">
                                                        <label>کد پترن ارسال کد تایید</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text" wire:model="userVerifyPattern"
                                                                   class="form-control ltr">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>متن نمونه ایجاد پترن</label>
                                                        <textarea readonly class="form-control resize-none"
                                                                  rows="4">کد تایید: %code% &#13;&#10 {{ $siteTitle }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($userWalletBalanceIncreasedSmsEnabled)
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 form-group mb-0">
                                                        <label>کد پترن افزایش موجودی</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text"
                                                                   wire:model="userWalletIncreasedSmsPattern"
                                                                   class="form-control ltr">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>متن نمونه ایجاد پترن</label>
                                                        <textarea readonly class="form-control resize-none"
                                                                  rows="4">کاربر گرامی
موجودی کیف پول شما %amount% تومان افزایش یافت.
موجودی فعلی: %balance% تومان
کارنابیکس https://behwork.ir</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($userWalletBalanceDecreasedSmsEnabled)
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 form-group mb-0">
                                                        <label>کد پترن کاهش موجودی</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text"
                                                                   wire:model="userWalletDecreasedSmsPattern"
                                                                   class="form-control ltr">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>متن نمونه ایجاد پترن</label>
                                                        <textarea readonly class="form-control resize-none"
                                                                  rows="4">کاربر گرامی
موجودی کیف پول شما %amount% تومان کاهش یافت.
موجودی فعلی: %balance% تومان
کارنابیکس https://behwork.ir</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($afterExamPaidSmsEnabled)
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>کد پترن ارسال پیامک بعد از خرید آزمون</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text" wire:model="afterExamPaidVoucherPattern"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>درصد تخفیف</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text"
                                                                   wire:model="afterExamPaidVoucherPercentage"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>کد تخفیف</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text" wire:model="afterExamPaidVoucherCode"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                        @error('sampleVoucherCode')
                                                        <small class="text-danger d-block">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>متن نمونه ایجاد پترن</label>
                                                        <textarea readonly class="form-control resize-none"
                                                                  rows="4">
ممنونیم از شما که مجموعه کارنابیکس را انتخاب کردید.
آیا میدانستید قبل از ورود به %course% میتوانید نمونه سوالات آزمون را با تخفیف ویژه تهیه کنید که با آشنایی بیشتر وارد آزمون شوید و به راحتی گواهینامه شغلی را دریافت کنید؟
کد تخفیف %percent% درصد : %code%
                                                                </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        @if($afterExamRejectedSmsEnabled)
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>کد پترن ارسال پیامک بعد از رد شدن آزمون</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text"
                                                                   wire:model="afterExamRejectedVoucherPattern"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>درصد تخفیف</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text"
                                                                   wire:model="afterExamRejectedVoucherPercentage"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form-group mb-0">
                                                        <label>کد تخفیف</label>
                                                        <div class="input-group mb-75">
                                                            <input type="text" wire:model="afterExamRejectedVoucherCode"
                                                                   class="form-control ltr"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>متن نمونه ایجاد پترن</label>
                                                        <textarea readonly class="form-control resize-none"
                                                                  rows="4">
متاسفانه شما در %course% قبول نشدید .
هنوز فرصت دارید تا از کد تخفیف ویژه ما که اینبار %percent%  میباشد استفاده کنید و دوره که شامل : نمونه سوالات+آموزش+آزمون است را تهیه کنید.
کد تخفیف %percent% : %code%
کارنابیکس https://behwork.ir
                                                                </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                            <button type="submit" class="btn btn-primary glow">ذخیره تغییرات
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <x-admin.forms.validation-errors/>
</div>
