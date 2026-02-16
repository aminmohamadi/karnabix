@if($step == 1)
    <form wire:submit.prevent="signUp()" class="space-y-3">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-foreground">ورود یا ثبت نام</div>
        </div>
        <div class="text-sm text-muted space-y-3">
            <p>لطفا شماره موبایل خود را وارد کنید</p>
        </div>

        <div class="flex items-center relative">
            <input name="phone" wire:model="phone" type="text" dir="ltr"
                   class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5" />

            @error('phone')
            <span class=" peer-invalid:block font-semibold text-xs text-error mt-2">
                          {{$message}}
                        </span>
            @enderror
        </div>
        <button type="submit"
                class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
            <span class="font-semibold text-sm">برو بریم</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd"
                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </form>
@endif
@if($step == 2)
    <form wire:submit.prevent="referral()" class="space-y-3">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-foreground">کد معرف دارید؟</div>
        </div>
        <div class="text-sm text-muted space-y-3">
            <p>کد معرف خود را در ورودی زیر ثبت کنید</p>
        </div>

        <!-- form:field:wrapper -->
        <div class="flex flex-col relative space-y-1">
            <input wire:model="ref" type="text" dir="ltr"
                   class="form-input w-full h-11 peer !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border invalid:!border-error rounded-xl text-lg tracking-9 text-center text-foreground invalid:!text-error placeholder:text-right px-5"
                   maxlength="6" />

            @error('ref')
            <span class=" peer-invalid:block font-semibold text-xs text-error mt-2">
                          {{$message}}
                        </span>
            @enderror
        </div>
        <div class="flex justify-center gap-1">
            <button type="submit"
                    class="flex items-center justify-center gap-1 w-3/5 h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                <span class="font-semibold text-sm">تایید</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <button type="button"
                    wire:click="skip_ref()"
                    class="flex items-center justify-center gap-1 w-1/4 h-10 bg-red-500 rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                <span class="font-semibold text-sm">بیخیال</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-error"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="white"
                >
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>
            </button>
        </div>

    </form>
@endif
@if($step == 3)
    <form wire:submit.prevent="login()" class="space-y-3">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-foreground">کد تایید را وارد کنید</div>
        </div>
        <div class="text-sm text-muted space-y-3">
            <p>کد تایید برای شماره <span dir="ltr">{{substr($phone, 0, 4) . '***' . substr($phone, -4)}}</span> پیامک شد</p>
        </div>

        <!-- form:field:wrapper -->
        <div class="flex flex-col relative space-y-1">
            <input wire:model="verify_code" type="text" inputmode="numeric" dir="ltr"
                   class="form-input w-full h-11 peer !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border invalid:!border-error rounded-xl text-lg tracking-9 text-center text-foreground invalid:!text-error placeholder:text-right px-5"
                   pattern="[0-9]+" maxlength="5" />

            @error('verify_code')
            <span class=" peer-invalid:block font-semibold text-xs text-error mt-2">
                          {{$message}}
                        </span>
            @enderror
        </div>
        <button type="submit"
                class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
            <span class="font-semibold text-sm">تایید</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd"
                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </form>
@endif
