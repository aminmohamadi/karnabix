<!DOCTYPE html>
<html lang="fa" dir="rtl">

@include('new.layouts.meta')

<body>
<div class="min-h-screen flex items-center justify-center bg-background p-5">
    <div class="w-full max-w-sm space-y-5">
        <div class="bg-gradient-to-b from-secondary to-background rounded-3xl space-y-5 px-5 pb-5">
            <div class="bg-background rounded-b-3xl space-y-2 p-5">
                <a href="{{route('home')}}" class="inline-flex items-center gap-2 text-primary">
                    <img class="h-10 w-10" src="{{$logo}}" alt="">
                    <span class="flex flex-col items-start">
                            <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                            <span class="font-black text-xl">{{$site_title}}</span>
                        </span>
                </a>
            </div>

            @yield('content')


        </div>
        <div class="bg-secondary rounded-xl space-y-5 p-5">
            <div class="font-medium text-xs text-center text-muted">
                ورود شما به معنای پذیرش <a href="{{route('faq')}}"
                                           class="text-foreground transition-colors hover:text-primary hover:underline">شرایط</a> و
                <a href="{{route('faq')}}" class="text-foreground transition-colors hover:text-primary hover:underline">قوانین
                </a> است.
            </div>
        </div>
    </div>
</div>



@include('new.layouts.scripts')
</body>

</html>
