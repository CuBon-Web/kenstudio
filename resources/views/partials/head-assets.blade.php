@php
    $r2Base = rtrim(config('filesystems.disks.r2.url') ?? '', '/');
    $deferStylesheets = [
        'fontawesome.min.css',
        'venobox.min.css',
        'odometer.min.css',
        'animation.css',
        'twentytwenty.min.css',
        'swiper.min.css',
    ];
@endphp
@if($r2Base)
<link rel="preconnect" href="{{ $r2Base }}" crossorigin>
<link rel="dns-prefetch" href="{{ $r2Base }}">
@endif
<link rel="stylesheet" href="{{ r2_asset('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ r2_asset('frontend/css/subfont.css') }}">
<link rel="stylesheet" href="{{ r2_asset('frontend/css/main.css') }}">
@foreach($deferStylesheets as $cssFile)
<link rel="stylesheet" href="{{ r2_asset('frontend/css/' . $cssFile) }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ r2_asset('frontend/css/' . $cssFile) }}"></noscript>
@endforeach
