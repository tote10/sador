@php
    $siteName = 'Sador General Construction';
    $defaultDescription = 'Sador General Construction is a trusted general contractor delivering premier commercial, residential, and civil infrastructure projects across Ethiopia.';
    $ogImageDefault = asset('images/hero-building1.jpg');
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $siteName }}</title>
    <meta name="description" content="@yield('meta_description', $defaultDescription)">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#003087">

    {{-- Icons & manifest --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Geo --}}
    <meta name="geo.region" content="ET-AA">
    <meta name="geo.placename" content="Addis Ababa">
    <meta name="geo.position" content="9.0042;38.7835">
    <meta name="ICBM" content="9.0042, 38.7835">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="@yield('title') - {{ $siteName }}">
    <meta property="og:description" content="@yield('meta_description', $defaultDescription)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', $ogImageDefault)">
    <meta property="og:image:alt" content="@yield('title') - {{ $siteName }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title') - {{ $siteName }}">
    <meta name="twitter:description" content="@yield('meta_description', $defaultDescription)">
    <meta name="twitter:image" content="@yield('og_image', $ogImageDefault)">
    <meta name="twitter:image:alt" content="@yield('title') - {{ $siteName }}">

    {{-- Google Search Console verification (renders only when configured) --}}
    @if(config('services.google.site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif

    {{-- Organization structured data (JSON-LD) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GeneralContractor",
        "name": "Sador General Construction",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "image": "{{ asset('images/hero-building1.jpg') }}",
        "telephone": ["+251911708175", "+251976808076"],
        "email": "Sadorgcsador@gmail.com",
        "foundingDate": "2019",
        "areaServed": "ET",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Alemnesh Plaza, 13th Floor, Room 1303",
            "addressLocality": "Addis Ababa",
            "addressCountry": "ET"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 9.0042,
            "longitude": 38.7835
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "opens": "08:00",
            "closes": "17:30"
        }
    }
    </script>

    {{-- Per-page structured data --}}
    @stack('schema')

    <!-- Preconnections -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- AOS Library (non-render-blocking) -->
    <link rel="preload" as="style" href="https://unpkg.com/aos@next/dist/aos.css" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /></noscript>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Analytics 4 (renders only when configured) --}}
    @if(config('services.google.analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
    @endif
</head>
<body class="font-body antialiased text-slate-900 bg-slate-50 overflow-x-hidden">
    @include('components.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('components.footer')
    @include('components.floating-buttons')
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
            
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    once: true,
                    offset: 50,
                    duration: 800,
                    easing: 'ease-out-cubic',
                });
            }
        });
    </script>
</body>
</html>