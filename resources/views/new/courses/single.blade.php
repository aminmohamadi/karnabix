<div class="max-w-7xl space-y-14 px-4 mx-auto" wire:init="loadCourse">
    <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
        <div class="md:w-8/12 w-full">
            <div class="relative">
                <div class="relative z-10">

                    @if(!is_null($local_video))
                        <div class="w-full" id="videoContent">
                            <!-- section:title -->
                            <div class="flex items-center gap-5 mb-5">

                                <div class="flex flex-col space-y-2">
                                    <!-- episode:title -->
                                    <span id="episode_title" class="font-black text-2xl text-primary">معرفی دوره</span>
                                    <!-- course:title -->
                                    <span class="font-semibold text-xs text-muted">{{$course->title}}</span>
                                </div>
                            </div>

                            <div class="relative max-w-full rounded-3xl overflow-hidden z-10">
                                <video id="player" class="js-player" playsinline controls
                                       data-poster="{{asset($course->image)}}">
                                    <source src="{{$local_video}}" type="video/mp4"/>

                                </video>
                            </div>
                        </div>
                    @else
                        <div>
                            <img src="{{$course->image}}" class="max-w-full rounded-3xl"
                                 alt="{{$course->title}}"/>
                        </div>
                    @endif
                </div>
                <div class="-mt-12 pt-12">
                    <div
                        class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
                        <!-- course:status -->
                        <div class="flex items-center gap-2">
                            <span class="block w-1 h-1 bg-success rounded-full"></span>
                            <span class="font-bold text-xs text-success">{{$course->status_label}}</span>
                        </div>

                        <!-- course:title -->
                        <h1 class="font-bold text-xl text-foreground">{{$course->title}}</h1>

                        <!-- course:excerpt -->
                        <p class="text-sm text-muted">
                            {!! $course->short_body !!}
                        </p>
                    </div>
                    <div class="space-y-10 py-5">
                        <div class="grid lg:grid-cols-4 grid-cols-2 gap-5">
                            <div
                                class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                <div
                                    class="flex flex-col items-center justify-center text-center space-y-1">
                                    <span class="font-bold text-xs text-muted line-clamp-1">مدت دوره</span>
                                    <span
                                        class="font-bold text-sm text-foreground line-clamp-1">{{$course->time}}</span>
                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M4.25 2A2.25 2.25 0 0 0 2 4.25v2.5A2.25 2.25 0 0 0 4.25 9h2.5A2.25 2.25 0 0 0 9 6.75v-2.5A2.25 2.25 0 0 0 6.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 2 13.25v2.5A2.25 2.25 0 0 0 4.25 18h2.5A2.25 2.25 0 0 0 9 15.75v-2.5A2.25 2.25 0 0 0 6.75 11h-2.5Zm9-9A2.25 2.25 0 0 0 11 4.25v2.5A2.25 2.25 0 0 0 13.25 9h2.5A2.25 2.25 0 0 0 18 6.75v-2.5A2.25 2.25 0 0 0 15.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 11 13.25v2.5A2.25 2.25 0 0 0 13.25 18h2.5A2.25 2.25 0 0 0 18 15.75v-2.5A2.25 2.25 0 0 0 15.75 11h-2.5Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                <div
                                    class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span class="font-bold text-xs text-muted line-clamp-1">تعداد
                                                    جلسات</span>
                                    <span class="font-bold text-sm text-foreground line-clamp-1">
                                        {{$course->episodes->count() }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                <div
                                    class="flex flex-col items-center justify-center text-center space-y-1">
                                    <span class="font-bold text-xs text-muted line-clamp-1">نوع دوره</span>
                                    <span class="font-bold text-sm text-foreground line-clamp-1">
                                        {{$course->type_label}}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path
                                                        d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z">
                                                    </path>
                                                </svg>
                                            </span>
                                <div
                                    class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">شرکت‌کنندگان</span>
                                    <span class="font-bold text-sm text-foreground line-clamp-1">
                                        {{$course->SoldCount}}
                                                    دانشجو</span>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-4/12 w-full md:top-24 space-y-8 block md:hidden">
                            <div class="bg-gradient-to-b from-secondary to-background rounded-2xl px-5 pb-5">
                                <div class="bg-background rounded-b-3xl space-y-2 p-5 mb-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center gap-1">
                                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                        </div>
                                        <div class="font-black text-foreground">نام نویسی در دوره</div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-5">
                                    <span class="font-bold text-base text-muted">هزینه ثبت نام:</span>
                                    <div class="flex flex-col items-end justify-center h-14">
                                        @if($course->has_reduction && $course->base_price > 0 )
                                            <span
                                                class="line-through text-muted">{{ number_format($course->base_price) }} </span>
                                        @endif
                                        @if($course->price > 0)
                                            <div class="flex items-center gap-1">
                                <span
                                    class="font-black text-xl text-foreground">{{ number_format($course->price) }} </span>
                                                <span class="text-xs text-muted">تومان</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-1">
                                                <span class="font-black text-xl text-foreground">رایگان</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-3 mt-3">
                                    @if (auth()->check() && $user->hasCourse($course->id))
                                        <button type="button"
                                                disabled
                                                class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                            <span class="font-semibold text-sm">شما این دوره را خریداری کرده اید</span>
                                        </button>
                                    @else
                                        @if($course->price > 0)
                                            <button type="button"
                                                    wire:click="addToCart()"
                                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                                <span class="font-semibold text-sm">افزودن به سبد خرید</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor"
                                                     class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        @else
                                            <button type="button"
                                                    wire:click="getFreeOrder()"
                                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                                <span class="font-semibold text-sm">افزودن به سبد خرید</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor"
                                                     class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    @endif

                                    <button type="button"
                                            onclick="copyLink('{{$afl}}')"
                                            class="flex-shrink-0 w-11 h-11 inline-flex items-center justify-center bg-secondary rounded-full text-muted transition-colors hover:text-primary">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 17l6-6 4 4 8-8M14 7h7v7"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="bg-background rounded-b-3xl space-y-2 p-5 mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center gap-1">
                                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                        </div>
                                        <div class="font-black text-foreground">اشتراک گذاری دوره</div>
                                    </div>
                                </div>
                                <ul class="flex flex-wrap items-center gap-5 " style="justify-content: space-evenly">
                                    <li>
                                        <a href="https://api.whatsapp.com/send?text={{ route('codes',$course->short_code) }}"
                                           target="_blank"
                                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5"
                                                 viewBox="0 0 50 50">
                                                <path
                                                    d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://t.me/share/url?url={{ route('codes',$course->short_code) }}"
                                           target="_blank"
                                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5"
                                                 viewBox="0 0 50 50">
                                                <path
                                                    d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z"></path>
                                            </svg>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('codes',$course->short_code) }}"
                                           target="_blank"
                                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5"
                                                 viewBox="0 0 50 50">
                                                <path
                                                    d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text={{ route('codes',$course->short_code) }}"
                                           target="_blank"
                                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5"
                                                 viewBox="0 0 50 50">
                                                <path
                                                    d="M 5.9199219 6 L 20.582031 27.375 L 6.2304688 44 L 9.4101562 44 L 21.986328 29.421875 L 31.986328 44 L 44 44 L 28.681641 21.669922 L 42.199219 6 L 39.029297 6 L 27.275391 19.617188 L 17.933594 6 L 5.9199219 6 z M 9.7167969 8 L 16.880859 8 L 40.203125 42 L 33.039062 42 L 9.7167969 8 z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('codes',$course->short_code) }}"
                                           target="_blank"
                                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5"
                                                 viewBox="0 0 50 50">
                                                <path
                                                    d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.668484 6 44 7.3315161 44 9 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 14 11.011719 C 12.904779 11.011719 11.919219 11.339079 11.189453 11.953125 C 10.459687 12.567171 10.011719 13.484511 10.011719 14.466797 C 10.011719 16.333977 11.631285 17.789609 13.691406 17.933594 A 0.98809878 0.98809878 0 0 0 13.695312 17.935547 A 0.98809878 0.98809878 0 0 0 14 17.988281 C 16.27301 17.988281 17.988281 16.396083 17.988281 14.466797 A 0.98809878 0.98809878 0 0 0 17.986328 14.414062 C 17.884577 12.513831 16.190443 11.011719 14 11.011719 z M 14 12.988281 C 15.392231 12.988281 15.94197 13.610038 16.001953 14.492188 C 15.989803 15.348434 15.460091 16.011719 14 16.011719 C 12.614594 16.011719 11.988281 15.302225 11.988281 14.466797 C 11.988281 14.049083 12.140703 13.734298 12.460938 13.464844 C 12.78117 13.19539 13.295221 12.988281 14 12.988281 z M 11 19 A 1.0001 1.0001 0 0 0 10 20 L 10 39 A 1.0001 1.0001 0 0 0 11 40 L 17 40 A 1.0001 1.0001 0 0 0 18 39 L 18 33.134766 L 18 20 A 1.0001 1.0001 0 0 0 17 19 L 11 19 z M 20 19 A 1.0001 1.0001 0 0 0 19 20 L 19 39 A 1.0001 1.0001 0 0 0 20 40 L 26 40 A 1.0001 1.0001 0 0 0 27 39 L 27 29 C 27 28.170333 27.226394 27.345035 27.625 26.804688 C 28.023606 26.264339 28.526466 25.940057 29.482422 25.957031 C 30.468166 25.973981 30.989999 26.311669 31.384766 26.841797 C 31.779532 27.371924 32 28.166667 32 29 L 32 39 A 1.0001 1.0001 0 0 0 33 40 L 39 40 A 1.0001 1.0001 0 0 0 40 39 L 40 28.261719 C 40 25.300181 39.122788 22.95433 37.619141 21.367188 C 36.115493 19.780044 34.024172 19 31.8125 19 C 29.710483 19 28.110853 19.704889 27 20.423828 L 27 20 A 1.0001 1.0001 0 0 0 26 19 L 20 19 z M 12 21 L 16 21 L 16 33.134766 L 16 38 L 12 38 L 12 21 z M 21 21 L 25 21 L 25 22.560547 A 1.0001 1.0001 0 0 0 26.798828 23.162109 C 26.798828 23.162109 28.369194 21 31.8125 21 C 33.565828 21 35.069366 21.582581 36.167969 22.742188 C 37.266572 23.901794 38 25.688257 38 28.261719 L 38 38 L 34 38 L 34 29 C 34 27.833333 33.720468 26.627107 32.990234 25.646484 C 32.260001 24.665862 31.031834 23.983076 29.517578 23.957031 C 27.995534 23.930001 26.747519 24.626988 26.015625 25.619141 C 25.283731 26.611293 25 27.829667 25 29 L 25 38 L 21 38 L 21 21 z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- tabs container -->
                        <div class="space-y-5"
                             x-data="{ activeTab: 'tabOne', scroll: function() { document.getElementById(this.activeTab).scrollIntoView({ behavior: 'smooth' }) } }">
                            <div class="sticky top-24 z-10">
                                <!-- tabs:list-container -->
                                <div class="relative overflow-x-auto">
                                    <!-- tabs:list -->
                                    <ul
                                        class="inline-flex gap-2 bg-secondary border border-border rounded-full p-1">
                                        <!-- tabs:list:item -->
                                        <li>
                                            <button type="button"
                                                    class="flex items-center gap-x-2 relative rounded-full py-2 px-4"
                                                    x-bind:class="activeTab === 'tabOne' ? 'text-foreground bg-background' : 'text-muted'"
                                                    x-on:click="activeTab = 'tabOne'; scroll();">
                                                <!-- active icon -->
                                                <span x-show="activeTab === 'tabOne'">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor"
                                                                     class="w-5 h-5">
                                                                    <path
                                                                        d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z">
                                                                    </path>
                                                                </svg>
                                                            </span><!-- end active icon -->

                                                <!-- inactive icon -->
                                                <span x-show="activeTab !== 'tabOne'">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                                                                    </path>
                                                                </svg>
                                                            </span><!-- end inactive icon -->

                                                <span
                                                    class="font-semibold text-sm whitespace-nowrap">معرفی</span>
                                            </button>
                                        </li><!-- end tabs:list:item -->

                                        <!-- tabs:list:item -->
                                        <li>
                                            <button type="button"
                                                    class="flex items-center gap-x-2 relative rounded-full py-2 px-4"
                                                    x-bind:class="activeTab === 'tabTwo' ? 'text-foreground bg-background' : 'text-muted'"
                                                    x-on:click="activeTab = 'tabTwo'; scroll();">
                                                <!-- active icon -->
                                                <span x-show="activeTab === 'tabTwo'">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor"
                                                                     class="w-5 h-5">
                                                                    <path fill-rule="evenodd"
                                                                          d="M6 4.75A.75.75 0 016.75 4h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 4.75zM6 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 10zm0 5.25a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75a.75.75 0 01-.75-.75zM1.99 4.75a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 15.25a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 10a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1V10z"
                                                                          clip-rule="evenodd"></path>
                                                                </svg>
                                                            </span><!-- end active icon -->

                                                <!-- inactive icon -->
                                                <span x-show="activeTab !== 'tabTwo'">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                                                                    </path>
                                                                </svg>
                                                            </span><!-- end inactive icon -->

                                                <span
                                                    class="font-semibold text-sm whitespace-nowrap">سرفصلها</span>
                                            </button>
                                        </li><!-- end tabs:list:item -->

                                        <!-- tabs:list:item -->
                                        <li>
                                            <button type="button"
                                                    class="flex items-center gap-x-2 relative rounded-full py-2 px-4"
                                                    x-bind:class="activeTab === 'tabThree' ? 'text-foreground bg-background' : 'text-muted'"
                                                    x-on:click="activeTab = 'tabThree'; scroll();">
                                                <!-- active icon -->
                                                <span x-show="activeTab === 'tabThree'">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20" fill="currentColor"
                                                                     class="w-5 h-5">
                                                                    <path
                                                                        d="M3.505 2.365A41.369 41.369 0 0 1 9 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 0 0-.577-.069 43.141 43.141 0 0 0-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 0 1 5 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914Z">
                                                                    </path>
                                                                    <path
                                                                        d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 0 0 1.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0 0 14 6Z">
                                                                    </path>
                                                                </svg>
                                                            </span><!-- end active icon -->

                                                <!-- inactive icon -->
                                                <span x-show="activeTab !== 'tabThree'">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155">
                                                                    </path>
                                                                </svg>
                                                            </span><!-- end inactive icon -->

                                                <span class="font-semibold text-sm whitespace-nowrap">دیدگاه
                                                                و پرسش</span>
                                            </button>
                                        </li><!-- end tabs:list:item -->
                                    </ul><!-- end tabs:list -->
                                </div><!-- end tabs:list-container -->
                            </div>

                            <!-- tabs:contents -->
                            <div class="space-y-8">
                                <!-- tabs:contents:tabOne -->
                                <div class="bg-background rounded-3xl p-5" id="tabOne">
                                    <div class="flex items-center gap-3 mb-5">
                                        <div class="flex items-center gap-1">
                                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                        </div>
                                        <div class="font-black text-foreground">معرفی دوره</div>
                                    </div>

                                    <!-- course:description -->
                                    <div class="description">
                                        {!! $course->long_body !!}
                                    </div>
                                    <!-- end course:description -->
                                </div><!-- end tabs:contents:tabOne -->
                                @if(sizeof($course->episodes) > 0)
                                    <!-- tabs:contents:tabTwo -->
                                    <div class="bg-background rounded-3xl p-5" id="tabTwo">
                                        <!-- section:title -->
                                        <div class="flex items-center gap-3 mb-5">
                                            <div class="flex items-center gap-1">
                                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                            </div>
                                            <div class="font-black text-foreground">سرفصلها</div>
                                        </div>
                                        <!-- end section:title -->

                                        <!-- course:sections:wrapper -->
                                        <div class="flex flex-col space-y-3">
                                            <!-- course:section:accordion -->
                                            @foreach($course->episodes as $key => $item)
                                                <div class="w-full"
                                                     x-data="{{  $key == 0 ? '{ open: true }' : '{ open: false }' }}">
                                                    <!-- accordion:button -->
                                                    <button type="button"
                                                            class="w-full h-14 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-foreground px-5"
                                                            x-bind:class="open ? 'text-foreground' : 'text-muted'"
                                                            x-on:click="open = !open">
                                                            <span class="flex items-center gap-3 text-right">
                                                                <span
                                                                    class="font-semibold text-xs text-foreground line-clamp-1">
                                                                    درس {{$item->view}}
                                                                </span>
                                                                <div class="w-1 h-1 bg-muted-foreground rounded-full">
                                                                </div>
                                                                <span
                                                                    class="font-semibold text-xs"> {{$item->title}}</span>

                                                            </span>
                                                        <span x-bind:class="open ? 'rotate-180' : ''">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                                                </svg>
                                                            </span>
                                                    </button>
                                                    <!-- end accordion:button -->


                                                    <!-- accordion:content -->
                                                    <div class="flex flex-col relative py-3 sm:pr-8 sm:pl-16"
                                                         x-show="open">
                                                        <!-- course:section:episodes:wrapper -->

                                                        <div class="space-y-1">
                                                            <div
                                                                class="flex sm:flex-nowrap flex-wrap items-center gap-3 sm:h-12 border border-border rounded-xl p-3">
                                                                <span class="text-xs text-muted">۱</span>
                                                                <div
                                                                    class="w-1 h-1 bg-muted-foreground rounded-full">
                                                                </div>
                                                                <span
                                                                    class="font-semibold text-xs text-foreground line-clamp-1 transition-all hover:underline">
                                                                        مشاهده ویدیو
                                                                    </span>
                                                                <div
                                                                    class="flex items-center justify-end gap-3 sm:w-auto w-full mr-auto">
                                                                        <span
                                                                            class="flex items-center gap-1 text-muted">
                                                                            <span class="text-xs">{{$item->time}}</span>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 fill="none" viewBox="0 0 24 24"
                                                                                 stroke-width="1.5"
                                                                                 stroke="currentColor"
                                                                                 class="w-4 h-4">
                                                                                <path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                    @if(($item['free'] || $course->price == 0) || (auth()->check() && $user->hasCourse($course->id)))

                                                                        @if(!empty($item['local_video']))
                                                                            @if($item['allow_show_local_video'])
                                                                                <button
                                                                                    wire:click="set_content('show_local_video','{{$item['id']}}','{{$item->title}}')"

                                                                                    class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">
                                                                                    <span class="text-xs">مشاهده</span>
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 20 20"
                                                                                        fill="currentColor"
                                                                                        class="w-5 h-5">
                                                                                        <path fill-rule="evenodd"
                                                                                              d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                                                              clip-rule="evenodd"></path>
                                                                                    </svg>
                                                                                </button>
                                                                            @endif
                                                                            @if ($item['downloadable_local_video'])
                                                                                <button
                                                                                    wire:click="set_content('local_video','{{$item['id']}}','{{$item->title}}')"

                                                                                    class="flex items-center bg-yellow-500 h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">
                                                                                    <span
                                                                                        class="text-xs">دانلود ویدئو</span>
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 20 20"
                                                                                        fill="currentColor"
                                                                                        class="w-5 h-5">
                                                                                        <path fill-rule="evenodd"
                                                                                              d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                                                              clip-rule="evenodd"></path>
                                                                                    </svg>
                                                                                </button>

                                                                            @endif

                                                                        @endif
                                                                        @if(!empty($item['file']))
                                                                            <button
                                                                                wire:click="set_content('file','{{$item['id']}}','{{$item->title}}')"

                                                                                class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">
                                                                                <span class="text-xs">دانلود فایل</span>
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     viewBox="0 0 20 20"
                                                                                     fill="currentColor"
                                                                                     class="w-5 h-5">
                                                                                    <path fill-rule="evenodd"
                                                                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                                                          clip-rule="evenodd"></path>
                                                                                </svg>
                                                                            </button>
                                                                        @endif

                                                                    @else
                                                                        <button
                                                                            disabled

                                                                            class="flex items-center h-9 gap-1 bg-red-500 rounded-full text-white transition-colors px-4">
                                                                            <span
                                                                                class="text-xs">خریداری نشده است</span>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 20 20" fill="currentColor"
                                                                                 class="w-5 h-5">
                                                                                <path fill-rule="evenodd"
                                                                                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                                                      clip-rule="evenodd"></path>
                                                                            </svg>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end course:section:episodes:wrapper -->
                                                    </div>
                                                    <!-- end accordion:content -->

                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @else
                                    <div class="lg:col-span-9 md:col-span-8" id="tabTwo">
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
                                                                                هنوز هیچ درسی آپلود نشده.
                                                                            </div>

                                                                            <div
                                                                                class="font-semibold text-xs text-zinc-400">
                                                                                در حال آپلود درس ها هستیم. لطفا کمی صبر
                                                                                کنید
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
                                    </div>
                                @endif

                                <div class="bg-background rounded-3xl p-5" id="tabThree">
                                    @include('new.components.comments')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:w-4/12 w-full md:sticky md:top-24 space-y-8 hidden md:block">
            <div class="bg-gradient-to-b from-secondary to-background rounded-2xl px-5 pb-5">
                <div class="bg-background rounded-b-3xl space-y-2 p-5 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">نام نویسی در دوره</div>
                    </div>
                </div>
                <div class="flex items-center justify-between gap-5">
                    <span class="font-bold text-base text-muted">هزینه ثبت نام:</span>
                    <div class="flex flex-col items-end justify-center h-14">
                        @if($course->has_reduction && $course->base_price > 0 )
                            <span class="line-through text-muted">{{ number_format($course->base_price) }} </span>
                        @endif
                        @if($course->price > 0)
                            <div class="flex items-center gap-1">
                                <span
                                    class="font-black text-xl text-foreground">{{ number_format($course->price) }} </span>
                                <span class="text-xs text-muted">تومان</span>
                            </div>
                        @else
                            <div class="flex items-center gap-1">
                                <span class="font-black text-xl text-foreground">رایگان</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3 mt-3">
                    @if (auth()->check() && $user->hasCourse($course->id))
                        <button type="button"
                                disabled
                                class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                            <span class="font-semibold text-sm">شما این دوره را خریداری کرده اید</span>
                        </button>
                    @else
                        @if($course->price > 0)
                            <button type="button"
                                    wire:click="addToCart()"
                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                <span class="font-semibold text-sm">افزودن به سبد خرید</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @else
                            <button type="button"
                                    wire:click="getFreeOrder()"
                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                <span class="font-semibold text-sm">افزودن به سبد خرید</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @endif
                    @endif

                    <button type="button"
                            onclick="copyLink('{{$afl}}')"
                            class="flex-shrink-0 w-11 h-11 inline-flex items-center justify-center bg-secondary rounded-full text-muted transition-colors hover:text-primary">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 17l6-6 4 4 8-8M14 7h7v7"/>
                        </svg>
                    </button>
                </div>
                <div class="bg-background rounded-b-3xl space-y-2 p-5 mb-2">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">اشتراک گذاری دوره</div>
                    </div>
                </div>
                <ul class="flex flex-wrap items-center gap-5 " style="justify-content: space-evenly">
                    <li>
                        <a href="https://api.whatsapp.com/send?text={{ route('codes',$course->short_code) }}"
                           target="_blank"
                           class="flex items-center justify-center w-12 h-12 bg-secondary  rounded-full text-foreground transition-colors hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" viewBox="0 0 50 50">
                                <path
                                    d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://t.me/share/url?url={{ route('codes',$course->short_code) }}" target="_blank"
                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full transition-colors hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5 text-primary"
                                 viewBox="0 0 50 50">
                                <path
                                    d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z"></path>
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('codes',$course->short_code) }}"
                           target="_blank"
                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" viewBox="0 0 50 50">
                                <path
                                    d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/intent/tweet?text={{ route('codes',$course->short_code) }}"
                           target="_blank"
                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" viewBox="0 0 50 50">
                                <path
                                    d="M 5.9199219 6 L 20.582031 27.375 L 6.2304688 44 L 9.4101562 44 L 21.986328 29.421875 L 31.986328 44 L 44 44 L 28.681641 21.669922 L 42.199219 6 L 39.029297 6 L 27.275391 19.617188 L 17.933594 6 L 5.9199219 6 z M 9.7167969 8 L 16.880859 8 L 40.203125 42 L 33.039062 42 L 9.7167969 8 z"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('codes',$course->short_code) }}"
                           target="_blank"
                           class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-5 w-5" viewBox="0 0 50 50">
                                <path
                                    d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.668484 6 44 7.3315161 44 9 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 14 11.011719 C 12.904779 11.011719 11.919219 11.339079 11.189453 11.953125 C 10.459687 12.567171 10.011719 13.484511 10.011719 14.466797 C 10.011719 16.333977 11.631285 17.789609 13.691406 17.933594 A 0.98809878 0.98809878 0 0 0 13.695312 17.935547 A 0.98809878 0.98809878 0 0 0 14 17.988281 C 16.27301 17.988281 17.988281 16.396083 17.988281 14.466797 A 0.98809878 0.98809878 0 0 0 17.986328 14.414062 C 17.884577 12.513831 16.190443 11.011719 14 11.011719 z M 14 12.988281 C 15.392231 12.988281 15.94197 13.610038 16.001953 14.492188 C 15.989803 15.348434 15.460091 16.011719 14 16.011719 C 12.614594 16.011719 11.988281 15.302225 11.988281 14.466797 C 11.988281 14.049083 12.140703 13.734298 12.460938 13.464844 C 12.78117 13.19539 13.295221 12.988281 14 12.988281 z M 11 19 A 1.0001 1.0001 0 0 0 10 20 L 10 39 A 1.0001 1.0001 0 0 0 11 40 L 17 40 A 1.0001 1.0001 0 0 0 18 39 L 18 33.134766 L 18 20 A 1.0001 1.0001 0 0 0 17 19 L 11 19 z M 20 19 A 1.0001 1.0001 0 0 0 19 20 L 19 39 A 1.0001 1.0001 0 0 0 20 40 L 26 40 A 1.0001 1.0001 0 0 0 27 39 L 27 29 C 27 28.170333 27.226394 27.345035 27.625 26.804688 C 28.023606 26.264339 28.526466 25.940057 29.482422 25.957031 C 30.468166 25.973981 30.989999 26.311669 31.384766 26.841797 C 31.779532 27.371924 32 28.166667 32 29 L 32 39 A 1.0001 1.0001 0 0 0 33 40 L 39 40 A 1.0001 1.0001 0 0 0 40 39 L 40 28.261719 C 40 25.300181 39.122788 22.95433 37.619141 21.367188 C 36.115493 19.780044 34.024172 19 31.8125 19 C 29.710483 19 28.110853 19.704889 27 20.423828 L 27 20 A 1.0001 1.0001 0 0 0 26 19 L 20 19 z M 12 21 L 16 21 L 16 33.134766 L 16 38 L 12 38 L 12 21 z M 21 21 L 25 21 L 25 22.560547 A 1.0001 1.0001 0 0 0 26.798828 23.162109 C 26.798828 23.162109 28.369194 21 31.8125 21 C 33.565828 21 35.069366 21.582581 36.167969 22.742188 C 37.266572 23.901794 38 25.688257 38 28.261719 L 38 38 L 34 38 L 34 29 C 34 27.833333 33.720468 26.627107 32.990234 25.646484 C 32.260001 24.665862 31.031834 23.983076 29.517578 23.957031 C 27.995534 23.930001 26.747519 24.626988 26.015625 25.619141 C 25.283731 26.611293 25 27.829667 25 29 L 25 38 L 21 38 L 21 21 z"></path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>
    <script>
        $(document).ready(function () {

            Livewire.on('showVideo', data => {
                $('html, body').animate({
                    scrollTop: $("#videoContent").offset().top
                }, 1);
            })
            $(".goToCommentForm").click(function () {
                $('html, body').animate({
                    scrollTop: $("#commentForm").offset().top
                }, 1000);
            });
            Livewire.on('notify', data => {
                Swal.fire({
                    position: 'top-end',
                    icon: data.icon,
                    title: data.title,
                    showConfirmButton: false,
                    timer: 3500,
                    toast: true,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
            })
        })

        Livewire.on('scrollToComments', function () {
            $('html, body').animate({
                scrollTop: $("#commentForm").offset().top
            }, 500);
        })

    </script>
    <script>
        function copyLink(text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    emitNotify('لینک با موفقیت کپی شد');
                });
        }

        function emitNotify(message) {
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        }
    </script>

 <script>


        let hls;

        Livewire.on('setVideo', data => {
            const video = document.getElementById('player');
            document.getElementById('episode_title').innerText = data.title;

            const videoSrc = data.src;

            if (hls) {
                hls.destroy();
            }

            if (Hls.isSupported()) {
                hls = new Hls();
                hls.attachMedia(video);
                hls.on(Hls.Events.MEDIA_ATTACHED, function() {
                    hls.loadSource(videoSrc);
                    hls.on(Hls.Events.MANIFEST_PARSED, function() {
                        video.play().catch(err => {
                            console.warn("Auto-play prevented:", err);
                        });
                    });
                });
                hls.on(Hls.Events.ERROR, function (event, data) {
                    console.error("❌ HLS.js Error:", data);
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = videoSrc;
                video.play().catch(err => {
                    console.warn("Auto-play prevented:", err);
                });
            } else {
                console.error("❌ HLS not supported in this browser.");
            }
        });
    </script>
@endpush
