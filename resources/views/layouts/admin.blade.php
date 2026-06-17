<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Sador Construction</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Preconnections -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-body antialiased text-slate-850 bg-slate-50 admin-white-theme" 
      x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar for Desktop -->
        <aside class="hidden md:flex flex-col w-64 bg-slate-900 border-r border-slate-800 shrink-0">
            <div class="h-20 flex items-center px-6 border-b border-slate-800 bg-slate-950/20">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto object-contain bg-white rounded px-1.5 py-0.5" alt="Sador Construction Logo">
                    <div>
                        <h1 class="text-sm font-display font-extrabold text-white tracking-wider leading-none uppercase">Sador Admin</h1>
                        <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Construction</span>
                    </div>
                </a>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                @include('layouts.admin-nav')
            </nav>
            <div class="p-4 border-t border-slate-800 bg-slate-950/20 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-sador-blue/30 text-sador-blue flex items-center justify-center font-bold text-sm uppercase border border-sador-blue/20">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</h4>
                        <span class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Super Administrator</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Drawer Menu -->
        <div x-show="sidebarOpen" 
             class="fixed inset-0 z-50 md:hidden" 
             style="display: none;" 
             role="dialog" 
             aria-modal="true">
            <!-- Backdrop -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" 
                 @click="sidebarOpen = false"></div>

            <!-- Drawer panel -->
            <aside x-show="sidebarOpen" 
                   x-transition:enter="transition ease-in-out duration-300 transform"
                   x-transition:enter-start="-translate-x-full"
                   x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in-out duration-300 transform"
                   x-transition:leave-start="translate-x-0"
                   x-transition:leave-end="-translate-x-full"
                   class="fixed inset-y-0 left-0 w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-50">
                <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto object-contain bg-white rounded px-1.5 py-0.5" alt="Sador Logo">
                        <span class="text-sm font-display font-extrabold text-white tracking-widest leading-none uppercase">Sador Admin</span>
                    </a>
                    <button @click="sidebarOpen = false" class="text-slate-400 hover:text-slate-200">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                    @include('layouts.admin-nav')
                </nav>
            </aside>
        </div>

        <!-- Main Workspace -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header bar -->
            <header class="h-20 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-6 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-slate-400 hover:text-slate-200 focus:outline-none">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h2 class="text-lg font-display font-extrabold text-white tracking-tight">@yield('title')</h2>
                </div>

                <div class="flex items-center gap-6">
                    <a href="/" target="_blank" class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition uppercase tracking-wider">
                        Public Website
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>

                    <div class="h-6 w-px bg-slate-800 hidden sm:block"></div>

                    <!-- User Actions -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-sador-orange to-amber-500 text-white flex items-center justify-center font-bold text-sm uppercase shadow-lg shadow-sador-orange/15 group-hover:scale-105 transition-transform duration-300">
                                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white transition hidden sm:inline">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-white transition"></i>
                        </button>

                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-3 w-48 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl py-2 z-30"
                             style="display: none;"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            <div class="px-4 py-2 border-b border-slate-800 mb-1">
                                <h4 class="text-xs font-bold text-white">{{ auth()->user()->name ?? 'Admin' }}</h4>
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Administrator</span>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition">
                                <i data-lucide="user" class="w-4 h-4 opacity-60"></i> My Account
                            </a>
                            <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition">
                                <i data-lucide="settings" class="w-4 h-4 opacity-60"></i> Settings
                            </a>
                            <a href="{{ route('logout') }}" 
                               class="flex items-center gap-2 px-4 py-2.5 text-xs text-red-400 hover:bg-slate-800 transition"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-lucide="log-out" class="w-4 h-4 opacity-60"></i> Log Out
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content Area -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8 bg-slate-950">
                <!-- Notifications / Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 shrink-0 text-green-400"></i>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 text-red-400"></i>
                        <span class="text-xs font-semibold">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>