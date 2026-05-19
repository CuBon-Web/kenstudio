
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#d70018">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name='revisit-after' content='2 days' />
    <meta name="viewport" content="width=device-width">
    <title>@yield('title')</title>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta http-equiv="Content-Language" content="vi" />
    <link rel="alternate" href="{{url()->current()}}" hreflang="vi-vn" />
    <meta name="description" content="@yield('description')">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="1 days" />
    <meta name="generator" content="@yield('title')" />
    <meta name="rating" content="General">
    <meta name="application-name" content="@yield('title')" />
    <meta name="theme-color" content="#ed3235" />
    <meta name="msapplication-TileColor" content="#ed3235" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="{{url()->current()}}" />
    <link rel="apple-touch-icon-precomposed" href="@yield('image')" sizes="700x700">
    <meta property="og:url" content="">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')">
    <meta property="og:site_name" content="{{url()->current()}}">
    <meta property="og:image:alt" content="@yield('title')">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@{{url()->current()}}" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="@yield('image')" />
    <meta name="twitter:url" content="" />
    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('description')">
    <meta itemprop="image" content="@yield('image')">
    <meta itemprop="url" content="">
    <link rel="canonical" href="{{\Request::url()}}">
    <!-- <link rel="amphtml" href="amp/" /> -->
    <link rel="image_src" href="@yield('image')" />
    <link rel="image_src" href="@yield('image')" />
    <link rel="shortcut icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <link rel="icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('partials.head-assets')
    @yield('css')
    @yield('schema')
</head>
<body>
    <!-- on page load modal -->
  
    @php
        $hotlineValue = $setting->hotline ?? $setting->phone1 ?? '';
        $hotlineDigits = preg_replace('/\D+/', '', (string) $hotlineValue);
        $waDigits = $hotlineDigits;
        if ($waDigits && substr($waDigits, 0, 1) === '0') {
            $waDigits = '84' . substr($waDigits, 1);
        } elseif ($waDigits && substr($waDigits, 0, 2) !== '84') {
            $waDigits = '84' . $waDigits;
        }
        $whatsappLink = $waDigits ? 'https://wa.me/' . $waDigits : '';
        $messengerLink = !empty($setting->messenger) ? $setting->messenger : '';
        $facebookLink = !empty($setting->facebook) ? $setting->facebook : '';
        $gmailLink = !empty($setting->email) ? 'mailto:' . $setting->email : '';
        $hasFloatingContact = $whatsappLink || $messengerLink || $facebookLink || $gmailLink;
    @endphp

 @include('layouts.header.index')
 <div id="antra-smooth-wrapper">
    <div id="antra-smooth-content">
       @yield('content')
       @include('layouts.footer.index')
       <!-- ./ footer-section -->
    </div>
 </div>
 <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>
 @if($hasFloatingContact)
 <div class="floating-contact" id="floatingContact" aria-label="Liên hệ nhanh">
    <div class="floating-contact__list" id="floatingContactList">
        @if($whatsappLink)
        <a href="{{ $whatsappLink }}" class="floating-contact__item floating-contact__item--whatsapp" target="_blank" rel="noopener noreferrer" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="floating-contact__label">WhatsApp</span>
        </a>
        @endif
        @if($messengerLink)
        <a href="{{ $messengerLink }}" class="floating-contact__item floating-contact__item--messenger" target="_blank" rel="noopener noreferrer" title="Messenger">
            <i class="fab fa-facebook-messenger"></i>
            <span class="floating-contact__label">Messenger</span>
        </a>
        @endif
        @if($facebookLink)
        <a href="{{ $facebookLink }}" class="floating-contact__item floating-contact__item--facebook" target="_blank" rel="noopener noreferrer" title="Facebook">
            <i class="fab fa-facebook-f"></i>
            <span class="floating-contact__label">Facebook</span>
        </a>
        @endif
        @if($gmailLink)
        <a href="{{ $gmailLink }}" class="floating-contact__item floating-contact__item--gmail" title="Gmail">
            <i class="fa-regular fa-envelope"></i>
            <span class="floating-contact__label">Gmail</span>
        </a>
        @endif
    </div>
    <button type="button" class="floating-contact__toggle" id="floatingContactToggle" aria-expanded="false" aria-controls="floatingContactList">
        <span class="floating-contact__toggle-icon floating-contact__toggle-icon--open"><i class="fa-regular fa-comments"></i></span>
        <span class="floating-contact__toggle-icon floating-contact__toggle-icon--close"><i class="fa-solid fa-xmark"></i></span>
        <span class="floating-contact__ring"></span>
        <span class="floating-contact__ring floating-contact__ring--delay"></span>
    </button>
 </div>
 @endif

 @include('partials.footer-scripts')
 @if($hasFloatingContact ?? false)
 <script>
 (function () {
    var wrap = document.getElementById('floatingContact');
    var btn = document.getElementById('floatingContactToggle');
    if (!wrap || !btn) return;
    btn.addEventListener('click', function () {
        var open = wrap.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
        if (!wrap.classList.contains('is-open')) return;
        if (!wrap.contains(e.target)) {
            wrap.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
 })();
 </script>
 @endif
@yield('js')
</body>
</html>




