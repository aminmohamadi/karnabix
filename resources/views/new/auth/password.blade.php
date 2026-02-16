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


    </div>
    @error('phone')
    <span class=" peer-invalid:block font-semibold text-xs text-error mt-2">
                          {{$message}}
                        </span>
    @enderror
    <div class="flex items-center relative">
        <input name="password" wire:model="password" type="password" dir="ltr"
               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5" />


    </div>
    @error('password')
    <span class=" peer-invalid:block font-semibold text-xs text-error mt-2">
                          {{$message}}
                        </span>
    @enderror
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
