<footer class="bg-slate-950 text-white border-t border-slate-900 pt-20 pb-12 font-sans overflow-hidden relative">
    <!-- Abstract light ray overlay -->
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-sador-blue/5 rounded-full filter blur-3xl opacity-60"></div>
    <div class="absolute top-0 left-0 w-96 h-96 bg-sador-orange/5 rounded-full filter blur-3xl opacity-60"></div>

    <div class="container mx-auto px-4 max-w-7xl relative z-10">
        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-16 border-b border-slate-900">
            <!-- Brand Section -->
            <div class="space-y-6">
                <a href="/" class="flex items-center block mb-6">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto object-contain bg-white rounded px-2 py-1" alt="Sador Construction Logo">
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Building East Africa's future with engineering precision, compromise-free structural integrity, and architectural luxury. 
                </p>
                <div class="flex items-center space-x-3 pt-2">
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-sador-orange hover:text-white transition-all duration-300 text-slate-400" title="Facebook">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-sador-orange hover:text-white transition-all duration-300 text-slate-400" title="LinkedIn">
                        <i data-lucide="linkedin" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-sador-orange hover:text-white transition-all duration-300 text-slate-400" title="Telegram">
                        <i data-lucide="send" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-display font-bold uppercase tracking-wider text-slate-100 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-sador-orange"></span>
                    Quick Navigation
                </h4>
                <ul class="space-y-3.5 text-sm text-slate-400 font-medium">
                    <li>
                        <a href="/about" class="hover:text-sador-orange hover:translate-x-1.5 transition-all duration-300 flex items-center gap-2 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-sador-orange transition-colors"></i>
                            About Sador
                        </a>
                    </li>
                    <li>
                        <a href="/services" class="hover:text-sador-orange hover:translate-x-1.5 transition-all duration-300 flex items-center gap-2 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-sador-orange transition-colors"></i>
                            Engineering Services
                        </a>
                    </li>
                    <li>
                        <a href="/projects" class="hover:text-sador-orange hover:translate-x-1.5 transition-all duration-300 flex items-center gap-2 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-sador-orange transition-colors"></i>
                            Featured Projects
                        </a>
                    </li>
                    <li>
                        <a href="/vacancies" class="hover:text-sador-orange hover:translate-x-1.5 transition-all duration-300 flex items-center gap-2 group">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600 group-hover:text-sador-orange transition-colors"></i>
                            Careers
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Coordinates -->
            <div>
                <h4 class="text-sm font-display font-bold uppercase tracking-wider text-slate-100 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-sador-orange"></span>
                    Get in Touch
                </h4>
                <ul class="space-y-4 text-sm text-slate-400 font-medium">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-sador-orange shrink-0 mt-0.5"></i>
                        <span>{{ $settings['company_address'] ?? 'ADDISABABA, ALEMNESH plaza building 13TH floor, Room No.1303' }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="phone" class="w-5 h-5 text-sador-orange shrink-0 mt-0.5"></i>
                        <div>
                            <a href="tel:{{ preg_replace('/[^+0-9]/', '', $settings['whatsapp_number'] ?? '+251911708175') }}" class="hover:text-sador-orange transition-colors block">{{ $settings['company_phone'] ?? '+2519 11 70 81 75 / +2519 76 80 80 76' }}</a>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-5 h-5 text-sador-orange shrink-0"></i>
                        <a href="mailto:{{ $settings['company_email'] ?? 'Sadorgcsador@gmail.com' }}" class="hover:text-sador-orange transition-colors">{{ $settings['company_email'] ?? 'Sadorgcsador@gmail.com' }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="clock" class="w-5 h-5 text-sador-orange shrink-0"></i>
                        <span>{{ $settings['working_hours'] ?? 'Mon - Sat: 8:00 AM - 5:30 PM' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="pt-10 flex flex-col md:flex-row justify-between items-center text-slate-500 text-xs gap-4">
            <p class="font-medium">&copy; {{ date('Y') }} Sador General Construction. Precision Crafted. All rights reserved.</p>
            <div class="flex items-center space-x-6 font-semibold">
                <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors duration-300">Sitemap</a>
            </div>
        </div>
    </div>
</footer>