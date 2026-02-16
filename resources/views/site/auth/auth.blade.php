<!DOCTYPE html>
<html lang="fa" dir="rtl">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>ورود</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{asset('admin/css/pages/login/classic/login-4.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('admin/plugins/global/plugins.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin/css/style.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('admin/css/themes/layout/header/base/light.rtl.css?v=7.0.6')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin/css/themes/layout/header/menu/light.rtl.css?v=7.0.6')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin/css/themes/layout/brand/dark.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/themes/layout/aside/dark.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/pages/wizard/wizard-2.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('site/js/sweetalert2.js')}}" defer></script>
    <style>
        /* Countdown-bar General */
        .countDownContainer {
            display: flex;
            justify-content: center;
        }

        div.countdown-bar {
            width: 250px;
            height: 2px;
            margin: 20px 0;
            background-color: #aaa;
            border-radius: 5px;
        }

        /* Loader */
        div.countdown-bar div:nth-of-type(1) {
            width: 0;
            height: 100%;
            border-radius: 5px;
        }

        /* Timer */
        div.countdown-bar div:nth-of-type(2) {
            width: 100%;
            height: 100%
        }

        div.countdown-bar span {
            display: block;
            text-align: center;
            font-family: unset!important;
        }

        div.countdown-bar span a {
            display: inline-block;
            margin-bottom: 20px;
            font-weight: normal;
        }

        div.countdown-bar div:nth-of-type(2) span {
            margin-top: 10px;
            display: block;
            text-align: center;
            font-weight: normal;
        }

        #otp-input {
            display: flex;
            justify-content: center;
            flex-direction: row-reverse;
            column-gap: 8px;
        }

        #otp-input input[type="number"] {
            -moz-appearance: textfield;
        }

        #otp-input input[type="number"]::-webkit-inner-spin-button, #otp-input input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #otp-input input {
            text-align: center;
            padding: 10px 8px 10px 8px;
            border: 1px solid #adadad;
            border-radius: 4px;
            outline: none;
            height: 64px;
            width: 50px;
        }
    </style>
    @stack('styles')
    @livewireStyles
    <!--end::Layout Themes-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body style="background: url({{asset('site/img/bg-auth.jpg')}});background-repeat: no-repeat;background-size: cover">

<div class="content vh-100">
    <div class="container-fluid h-100">
        <div class="auth h-100 d-flex align-items-center">
            <div class="container-fluid">
                <div class="auth-items">
                    <div class="row justify-content-center">
                        @yield('content')

                    </div>
                    <div class="row justify-content-center">
                        <p class="loginTermsDesc mt-3">با ورود و یا ثبت نام در شما <a
                                class="underlined main-color-one-color fw-bold"
                                href="">شرایط و
                                قوانین</a> استفاده از سرویس ها و <a class="underlined main-color-one-color fw-bold"
                                                                    href="">قوانین حریم
                                خصوصی</a> آن را می‌پذیرید.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('admin/js/scripts.bundle.js')}}"></script>
{{--<script src="https://keenthemes.com/metronic/assets/js/engage_code.js"></script>--}}
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
{{--<script src="{{asset('admin/js/pages/custom/login/login-general.js')}}"></script>--}}
<!--end::Page Scripts-->
<script src="{{asset('site/js/countdown/countdown.js')}}"></script>
<script src="{{ asset('site/js/otp-sms/otp-input.js') }}"></script>
<script src="{{ asset('site/js/one-time-login.js') }}"></script>
<script src="{{asset('site/js/otp-loader/script.js')}}"></script>
<script>
    $(document).ready(function (){
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

</script>
@livewireScripts
</body>
<!--end::Body-->
</html>
