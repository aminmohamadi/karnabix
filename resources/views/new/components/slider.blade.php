<div style="background-image: url({{asset($sliderImage)}});}"
    class=" bg-cover bg-center rounded-t-3xl rounded-b-3xl relative overflow-hidden md:px-20 px-8 md:pt-20 pt-10 md:pb-48 pb-32">
    <div class="relative space-y-8 z-20">
        <div class="flex flex-wrap items-center gap-2 h-[10vh]">

            <span class="font-semibold text-xs text-white"></span>
        </div>
        <h2 class="font-black sm:text-5xl text-3xl text-white">
            {{$slider_title}}
        </h2>
        <p class="sm:text-base text-sm text-white">
            {{$slider_sub_title}}
        </p>
        <a href="{{$sliderLink}}"
           class="inline-flex items-center justify-center gap-1 h-11 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
            <span class="font-semibold text-sm">{{$slider_button_text}}</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="w-5 h-5">
                <path fill-rule="evenodd"
                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                      clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
    <div class="absolute inset-0 bg-black/70"></div>

</div>
