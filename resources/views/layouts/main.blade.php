<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sador General Construction</title>
    <meta name="description" content="@yield('meta_description', 'Sador General Construction is a Grade-1 General Contractor delivering premier commercial, residential, and civil infrastructure projects across Ethiopia.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Preconnections -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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