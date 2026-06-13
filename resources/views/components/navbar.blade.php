<header class="w-full fixed top-0 left-0 right-0 z-50 transition-all duration-300 font-sans" 
        x-data="{ 
            open: false, 
            isScrolled: false,
            activeTab: window.location.pathname
        }" 
        x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 20 })"
        :class="isScrolled ? 'py-2' : 'py-4'">
    
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Floating Glass container -->
        <div class="rounded-2xl transition-all duration-500 border border-white/40 shadow-xl overflow-hidden"
             :class="isScrolled ? 'glass-nav bg-white/95 shadow-slate-900/5' : 'bg-white/95 border-slate-100 shadow-slate-200/40'">

            <!-- Main Navbar Content -->
            <div class="px-6 md:px-8 py-4 flex justify-between items-center">
                <!-- Branding / Logo -->
                <a href="/" class="flex items-center focus:outline-none">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 md:h-12 w-auto object-contain transition-transform hover:scale-[1.02]" alt="Sador General Construction Logo">
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center space-x-1 font-display">
                    @php
                        $links = [
                            '/' => 'Home',
                            '/about' => 'About',
                            '/services' => 'Services',
                            '/projects' => 'Projects',
                            '/vacancies' => 'Careers',
                            '/contact' => 'Contact'
                        ];
                    @endphp

                    @foreach($links as $path => $label)
                        <a href="{{ $path }}" 
                           class="relative px-4 py-2 text-sm font-semibold tracking-wide uppercase transition-all duration-300 hover:text-sador-blue focus:outline-none"
                           :class="activeTab === '{{ $path }}' ? 'text-sador-blue font-bold' : 'text-slate-600'">
                            {{ $label }}
                            <!-- Glowing Underline Indicator -->
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-sador-orange to-amber-500 transition-all duration-300 rounded-full"
                                  :class="activeTab === '{{ $path }}' ? 'w-2/3' : 'group-hover:w-1/2'"></span>
                        </a>
                    @endforeach

                    <!-- Contact Us Button -->
                    <div class="pl-6 ml-4 border-l border-slate-200">
                        <a href="/contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-sador-blue to-slate-900 hover:from-sador-orange hover:to-amber-500 text-white px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-500 hover:-translate-y-0.5 shadow-lg shadow-slate-950/10 hover:shadow-sador-orange/30 group">
                            Contact Us
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Mobile Hamburger Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button @click="open = true" class="text-slate-800 focus:outline-none p-2.5 rounded-xl hover:bg-slate-100 active:scale-95 transition-all">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Slide-out Drawer Panel -->
    <div x-show="open" 
         class="fixed inset-0 z-[100] lg:hidden" 
         style="display: none;" 
         role="dialog" 
         aria-modal="true">
        
        <!-- Backdrop Blur overlay -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = false" 
             class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm"></div>

        <!-- Drawer Content -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed inset-y-0 right-0 w-full max-w-sm bg-white shadow-2xl p-6 flex flex-col z-10 border-l border-slate-100">
            
            <!-- Drawer Header -->
            <div class="flex justify-between items-center pb-6 border-b border-slate-100">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto object-contain" alt="Sador Logo">
                </a>
                <button @click="open = false" class="text-slate-400 hover:text-slate-800 p-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Drawer Links -->
            <div class="py-8 flex-1 space-y-3 overflow-y-auto">
                @foreach($links as $path => $label)
                    <a href="{{ $path }}" 
                       class="flex items-center justify-between px-4 py-3.5 rounded-xl font-display font-bold uppercase text-sm tracking-wide border-l-4 transition-all"
                       :class="activeTab === '{{ $path }}' ? 'bg-sador-blue/5 border-sador-orange text-sador-blue' : 'border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                        {{ $label }}
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-40"></i>
                    </a>
                @endforeach
            </div>

            <!-- Drawer Footer Contact Details -->
            <div class="pt-6 border-t border-slate-100 space-y-4">
                <a href="tel:+251911708175" class="flex items-center gap-3 px-4 py-2.5 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors text-xs font-semibold text-slate-700">
                    <i data-lucide="phone" class="w-4 h-4 text-sador-orange"></i>
                    +2519 11 70 81 75
                </a>
                <a href="mailto:Sadorgcsador@gmail.com" class="flex items-center gap-3 px-4 py-2.5 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors text-xs font-semibold text-slate-700">
                    <i data-lucide="mail" class="w-4 h-4 text-sador-orange"></i>
                    Sadorgcsador@gmail.com
                </a>
                <a href="/contact" class="block w-full py-4 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-90 text-white rounded-xl text-center font-display font-extrabold text-sm uppercase tracking-widest shadow-lg shadow-sador-orange/20 transition-all">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</header>