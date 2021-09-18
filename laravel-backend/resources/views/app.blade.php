@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales'),
        'githubAuth' => config('services.github.client_id'),
    ];
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@csrf
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <link rel="shortcut icon" type="image/jpg" href="{{asset('dist/img/pages/favicon.png')}}"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script data-ad-client="ca-pub-8110132270270370" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-104845529-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-104845529-1');
    </script>


{{--  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">--}}

<!--     Fonts and icons     -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('dist/css/all.css') }}">
</head>
<body>
@csrf
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="app"></div>

{{-- Global configuration object --}}
<script>
    window.config = @json($config);
    window.Laravel = <?php echo json_encode([
//        'csrfToken' => csrf_token(),
//        'userId' => Auth::user()->id,
//        'permissions' => Auth::user()->getAllPermissions()->pluck('name')->toArray()
    ]); ?>
</script>

{{-- Load the application scripts --}}
<script src="{{ mix('dist/js/app.js') }}"></script>
<script src="{{ mix('dist/js/all.js') }}"></script>
</body>
</html>
