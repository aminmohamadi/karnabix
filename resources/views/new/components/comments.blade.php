@if(auth()->check())
    <div class="flex items-center gap-3 mb-5">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-foreground">دیدگاه و پرسش</div>
    </div>
    <div class="bg-background border border-border rounded-3xl p-5 mb-5">
        <div class="flex items-center gap-3 mb-5">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-xs text-foreground">
                ارسال دیدگاه یا پرسش
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-3 mb-5">
            <div class="flex items-center gap-3 sm:w-auto w-full">
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                    <img src="/{{auth()->user()->image}}"
                         class="w-full h-full object-cover" alt="..."/>
                </div>
                <div class="flex flex-col items-start space-y-1">
                                                    <span
                                                        class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">
                                                        @if(auth()->user()->details)
                                                            {{auth()->user()->details->fullname}}
                                                        @else
                                                            کاربر سایت
                                                        @endif
                                                        </span>
                </div>
            </div>

            @if($actionComment)
                <span class="block w-1 h-1 bg-border rounded-full"></span>
                <span class="font-semibold text-xs text-muted">در پاسخ به</span>
                <span class="block w-1 h-1 bg-border rounded-full"></span>
                <a href="#"
                   class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">
                    {{$replyTo}}

                </a>
                <button type="button"
                        wire:click="unsetReply()"
                        class="line-clamp-1 font-semibold text-sm text-red-500 mr-auto">
                    لغو
                    پاسخ
                </button>
            @endif


        </div>

        <form id="commentForm" class="flex flex-col space-y-5"
              wire:submit.prevent="new_comment">
                                                        <textarea
                                                            wire:model.defer="comment"
                                                            name="text" id="text" rows="10"
                                                            class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border border-border rounded-xl text-sm text-foreground p-5"
                                                            placeholder="متن مورد نظر خود را وارد کنید ..."></textarea>
            <div>
                <div class="g-recaptcha d-inline-block"
                     data-sitekey="{{ config('services.recaptcha.site_key') }}"
                     data-callback="reCaptchaCallback" wire:ignore></div>
                @error('recaptcha')<span class="invalid-feedback d-block">{{ $message
                                        }}</span>@enderror
            </div>
            <button type="submit"
                    class="h-10 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4 mr-auto">
                                                            <span class="font-semibold text-sm">ثبت دیدگاه یا
                                                                پرسش</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </form>
    </div>
    <div class="space-y-3">

        <div class="space-y-3">
            @if(sizeof($comments) > 0)
                @for($i=0;$i<$commentCount ;$i++)
                    @isset($comments[$i])
                        <div
                            class="bg-background border border-border rounded-3xl space-y-3 p-5">
                            <div
                                class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                        <img
                                            src="{{ asset($comments[$i]->user->image) }}"
                                            class="w-full h-full object-cover"
                                            alt="{{ $comments[$i]->user->name }}"/>
                                    </div>
                                    <div class="flex flex-col items-start space-y-1">
                                                            <span
                                                                class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">
                                                                {{$comments[$i]->user->details->fullName ?? "کاربر سایت"}}
                                                                </span>
                                        <span class="text-xs text-muted">
                                                                {{ $comments[$i]->created_at->diffForHumans()}}
                                                            </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 sm:mr-0 mr-auto">
                                    <button
                                        wire:click="replyToComment({{ $comments[$i]->id }})"
                                        class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">
                                        <span class="text-xs">پاسخ</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-muted">
                                {{$comments[$i]['content']}}
                            </p>
                        </div>
                        @if(!empty($comments[$i]->childrenRecursive))

                            <div
                                class="relative before:content-[''] before:absolute before:-top-3 before:right-8 before:w-px before:h-[calc(100%-24px)] before:bg-border after:content-[''] after:absolute after:bottom-9 after:right-8 after:w-8 after:h-px after:bg-border space-y-3 pr-16">

                                @foreach($comments[$i]->childrenRecursive as $value)
                                    <div
                                        class="bg-background border border-border rounded-3xl space-y-3 p-5">
                                        <div
                                            class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                                    <img
                                                        src="/{{$value->user->image}}"
                                                        class="w-full h-full object-cover"
                                                        alt="{{$value->user->details->fullname}}"/>
                                                </div>
                                                <div
                                                    class="flex flex-col items-start space-y-1">
                                                    <a href="#"
                                                       class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">
                                                        {{$value->user->details->fullname}}
                                                    </a>
                                                    <span class="text-xs text-muted">
                                                                                        {{ $value->created_at->diffForHumans()}}
                                                                                </span>
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center gap-3 sm:mr-0 mr-auto">

                                            </div>
                                        </div>
                                        <p class="text-sm text-muted">
                                            {{$value->content}}
                                        </p>
                                    </div>
                                @endforeach

                            </div>
                        @endif

                    @endif
                @endfor
            @endif

        </div>
    </div>
@else

    <div class="space-y-10">
        <div class="divide-y -mt-10">
            <div class="space-y-5 py-10">
                <div>
                    <div class="py-5 relative">
                        <div class="relative border border-border rounded-xl p-5">
                            <div class="relative">
                                <!-- alert -->
                                <div
                                    class="flex items-start gap-3 relative bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5"
                                    x-show="open" x-data="{ open: true }">
                                    <!-- alert:icon -->
                                    <span class="text-blue-500">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 class="w-5 h-5 text-error"
                                                                                 fill="none" viewBox="0 0 24 24"
                                                                                 stroke-width="1.5"
                                                                                 stroke="currentColor"
                                                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                                            </svg>
                                                        </span>

                                    <div class="flex flex-col items-start">
                                        <div
                                            class="font-bold text-sm text-error mb-2">
                                            فقط اعضای سایت امکان ثبت نظر را دارند
                                        </div>

                                        <div
                                            class="font-semibold text-xs text-zinc-400">
                                            برای عضویت یا ثبت نام <a class="text-primary" href="{{route('login-password')}}"> اینجا</a> را کلیک کنید
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
