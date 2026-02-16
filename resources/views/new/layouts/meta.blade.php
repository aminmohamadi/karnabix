<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <link rel="icon" type="image/svg+xml" href="{{asset($logo)}}" />
    <link rel="stylesheet" href="{{asset('assets/css/dependencies/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/dependencies/plyr.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/fonts.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('site/js/sweetalert2.js')}}" defer></script>
    <style>
        .plyr__poster{
            background-size:cover!important; ;
        }
    </style>
</head>
