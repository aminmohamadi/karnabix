<!DOCTYPE html>
<html lang="fa" dir="rtl">

@include('new.layouts.meta')

<body>
<style>
    #preloader {
        position: fixed;
        inset: 0;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    #preloader .spinner {
        width: 48px;
        height: 48px;
        border: 4px solid #3b82f6;
        border-top-color: transparent;
        border-radius: 9999px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
<div id="preloader" class="fixed inset-0 bg-white flex items-center justify-center z-50">
    <div class="spinner animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500">
    </div>
</div>
<div class="flex flex-col min-h-screen bg-background">
    <!-- header -->
    <livewire:site.includes.site.header/>
    <!-- end header -->

    <main class="flex-auto py-5">
        <div class="space-y-14">
            @yield('content')
        </div>
    </main>

    <!-- footer -->
    <livewire:site.includes.site.footer/>
    <!-- end footer -->
</div>


@include('new.layouts.scripts')
@stack("scripts")
</body>

</html>
