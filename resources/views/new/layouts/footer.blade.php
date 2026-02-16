<footer class="pt-20">
    <div class="max-w-7xl px-4 mx-auto">
        <div class="flex items-center gap-3">
            <div class="flex-grow border-t border-border border-dashed"></div>
            <button type="button"
                    class="flex-shrink-0 h-11 inline-flex items-center gap-3 bg-secondary rounded-full text-foreground transition-colors hover:text-primary px-4"
                    id="scrollToTopBtn">
                <span class="text-xs">برگشت به بالا</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"/>
                </svg>
            </button>
        </div>
        <div class="flex lg:flex-nowrap flex-wrap gap-8 py-10">
            <div class="md:w-5/12 w-full">
                <a href="{{route('home')}}" class="inline-flex items-center gap-2 text-primary">
                    <img class="w-6 h-6" src="{{asset($logo)}}" alt="">
                    <span class="flex flex-col items-start">
                                <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                                <span class="font-black text-xl">{{$title}}</span>
                            </span>
                </a>
            </div>
            <div class="md:w-7/12 w-full">
                <div class="flex flex-wrap items-center gap-10">
                    <div class="flex items-center gap-5">
                                <span
                                    class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                        <div class="flex flex-col font-black space-y-2">
                            <span class="text-sm text-primary">شماره تلفن</span>
                            <span class="text-foreground">{{$tel}}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                                <span
                                    class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-muted">
                                  <svg class="h-5 w-5" viewBox="0 0 48 48" version="1.1"
                                       xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="ic_fluent_mail_48_regular" fill="#212121" fill-rule="nonzero">
            <path
                d="M37.75,9 C40.6494949,9 43,11.3505051 43,14.25 L43,33.75 C43,36.6494949 40.6494949,39 37.75,39 L10.25,39 C7.35050506,39 5,36.6494949 5,33.75 L5,14.25 C5,11.3505051 7.35050506,9 10.25,9 L37.75,9 Z M40.5,18.351 L24.6023984,27.0952699 C24.2689733,27.2786537 23.8727436,27.2990297 23.5253619,27.1563978 L23.3976016,27.0952699 L7.5,18.351 L7.5,33.75 C7.5,35.2687831 8.73121694,36.5 10.25,36.5 L37.75,36.5 C39.2687831,36.5 40.5,35.2687831 40.5,33.75 L40.5,18.351 Z M37.75,11.5 L10.25,11.5 C8.73121694,11.5 7.5,12.7312169 7.5,14.25 L7.5,15.499 L24,24.573411 L40.5,15.498 L40.5,14.25 C40.5,12.7312169 39.2687831,11.5 37.75,11.5 Z"
            ></path>
        </g>
    </g>
</svg>
                                </span>
                        <div class="flex flex-col font-black space-y-2">
                            <span class="text-sm text-primary">ایمیل</span>
                            <span class="text-foreground">{{$email}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex md:flex-nowrap flex-wrap gap-8">
            <div class="md:w-5/12 w-full">
                <div class="bg-secondary rounded-3xl space-y-5 p-8">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">دربــــاره ما</div>
                    </div>
                    <p class="font-semibold text-sm text-muted">
                        {{$about_footer}}
                    </p>
                </div>
            </div>
            <div class="md:w-7/12 w-full">
                <div class="grid sm:grid-cols-5 gap-8">
                    <div class="sm:col-span-1 space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">لینک های مفید</div>
                        </div>
                        <ul class="flex flex-col space-y-1">
                            <li>
                                <a href="{{route('faq')}}"
                                   class="inline-flex font-semibold text-sm text-muted hover:text-primary">قوانین
                                    و
                                    مقررات</a>
                            </li>
                            <li>
                                <a href="{{route('about')}}"
                                   class="inline-flex font-semibold text-sm text-muted hover:text-primary">درباره
                                    ما</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}"
                                   class="inline-flex font-semibold text-sm text-muted hover:text-primary">ارتباط
                                    با
                                    ما</a>
                            </li>
                        </ul>
                    </div>
                    <div class="sm:col-span-1 space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground font-size-sm">نماد های اعتماد</div>
                        </div>
                        <div class="swiper auto-swiper-slider">

                            <div class="swiper-wrapper">

                                @foreach($autographs as $item)
                                    <div class="swiper-slide pb-8">
                                    {!! $item !!}
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                    <div class="sm:col-span-3 space-y-5">
                        <div class="space-y-5">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1">
                                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                </div>
                                <div class="font-black text-foreground">اصالت سنجی گواهی نامه</div>
                            </div>
                            <p class="text-sm text-muted">
                           شماره گواهی نامه را وارد کنید
                            </p>
                            <form wire:submit.prevent="checkCertificate()">
                                <div class="flex items-center gap-3 relative">
                                            <span class="absolute right-3 text-muted">
                                            <i class="la la-certificate pr-2 la-2x"></i>
                                            </span>
                                    <input
                                    wire:loading.attr="disabled" 
                                    type="text"
                                           wire:model="cert"
                                           class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border rounded-xl text-sm text-foreground pr-10"
                                           placeholder="شماره گواهی نامه" required/>
                                    <button
                                    wire:loading.attr="disabled"
                                    type="submit"
                                            class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-xl whitespace-nowrap text-xs text-primary-foreground transition-all hover:opacity-80 px-4">
                                       بررسی
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="space-y-5">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1">
                                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                </div>
                                <div class="font-black text-foreground">شبکه های اجتماعی</div>
                            </div>
                            <ul class="flex flex-wrap items-center gap-5">
                                <li>
                                    <a href="{{$instagram}}"
                                       class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="w-5 h-5">
                                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$telegram}}"
                                       class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="w-5 h-5">
                                            <path d="m22 2-7 20-4-9-9-4Z"></path>
                                            <path d="M22 2 11 13"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$twitter}}"
                                       class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="w-5 h-5">
                                            <path
                                                d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17">
                                            </path>
                                            <path d="m10 15 5-3-5-3z"></path>
                                        </svg>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{$youtube}}"
                                       class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="w-5 h-5">
                                        >
                                            <path id="primary"
                                                  d="M18.94,7.91A3.49,3.49,0,0,0,12,8.17C8.46,9.63,5,6,5,6c-1,6,2,8.75,2,8.75C5.64,16,3,16,3,16s1.58,3,8.58,3S19,11,19,11a3.08,3.08,0,0,0,2-3.3A7.9,7.9,0,0,1,18.94,7.91Z"
                                                  style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3 py-5">
            <p class="text-xs text-muted">{{$copyRight}}</p>
            <div class="flex-grow border-t border-border border-dashed"></div>
        </div>
    </div>
</footer>
