<!DOCTYPE html>
<html lang="id"
    @if (Request::is('auth/*')) class="dark-style customizer-hide" data-theme="theme-default"
   @else   data-theme="dark" @endif>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/' . $website->header->favicon) }}">

    <meta name="description" content="{!! $website->header->description !!}">
    <meta name="keyword" content="{{ $website->header->keywords }}">
    <meta name="author" content="@akiracode">
    <meta name="theme-color" content="{{ $website->header->theme_color }}" />
    <meta name="robots" content="index, follow">
    <meta content="desktop" name="device">
    <meta name="coverage" content="Worldwide">
    <meta name="apple-mobile-web-app-title" content="{{ $website->header->apple_mobile_web_app_title }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $website->header->og->title }}">
    <meta property="og:site_name" content="{{ $website->header->og->site_name }}">
    <meta property="og:description" content="{!! $website->header->og->description !!}">
    <meta property="og:image" content="{{ asset('assets/images/icon/' . $website->header->og->image->url) }}">
    <meta property="og:image:alt" content="{{ $website->header->og->image->alt }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --bg-body: #f6f8fd;
            --bg-dark: #0e1221;
            --primary-color: {{ $website->header->theme_color }};
            --secondary-color: #0e1221;
            --light-yellow: #deffea;
            --light-blue: #252f45e6;
            --dark-blue: #0e1221;
            --black: #34364a;
            --black-text: #6b7c8e;
            --dark-grey: #e5e9f2;
            --navbar: #14192be3;
            --light-grey: #f6f8fd;
            --white: #fff;
        }
    </style>

    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="antialiased">
    @routes
    @inertia
    <div id="StoreContainer"></div>
    <a id="backToTopBtn" onclick="scrollToTop()"
        class="floating-btu d-flex justify-content-center gap-1 flex-column contact d-none" tabindex="0">
        <i class="bi bi-arrow-up"></i>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>

</html>
