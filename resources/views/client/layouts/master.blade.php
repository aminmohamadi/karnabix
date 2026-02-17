<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('new.layouts.meta')
<body>

<div class="flex flex-col min-h-screen bg-background">
    <!-- header -->
{{--    @include('new.layouts.header-site')--}}
    <!-- end header -->

    <main class="flex-auto py-5">
        <div class="max-w-7xl space-y-14 px-4 mx-auto">
            <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
                @include('client.layouts.sidebar')

                <div class="lg:col-span-9 md:col-span-8">
                    <div class="space-y-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
{{--    @include('new.layouts.footer')--}}
    @include('new.layouts.scripts')
    <!-- end footer -->
</div>


@include('client.layouts.foot')
</body>
</html>
