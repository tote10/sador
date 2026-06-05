@extends('layouts.main')

@section('title', 'Get in Touch with Our Engineers')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 brightness-[0.55] contrast-[1.2]" 
         style="background-image: url('{{ asset('images/hero-building1.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-10 text-center" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Corporate Contact</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight">Connect With Us</h1>
        <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
            Whether you need a Grade-1 project estimate, a feasibility survey, or career details, our engineers are here to assist.
        </p>
    </div>
</div>

    <!-- Contact Info & Form -->
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Glassmorphic Dual Panel Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 rounded-[32px] overflow-hidden border border-slate-100 shadow-2xl bg-white" data-aos="fade-up">
                
                <!-- Contact Details Commander Block -->
                <div class="bg-slate-950 text-white p-10 lg:p-16 flex flex-col justify-between relative overflow-hidden">
                    <!-- Atmospheric glowing ambient blobs -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-sador-blue/20 rounded-full filter blur-3xl opacity-60"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-sador-orange/10 rounded-full filter blur-3xl opacity-60"></div>
                    
                    <div class="relative z-10 space-y-12">
                        <div class="space-y-4">
                            <span class="text-sador-orange text-[10px] font-extrabold uppercase tracking-widest block">Available Globally</span>
                            <h2 class="text-3xl lg:text-4xl font-display font-extrabold">Executive Headquarters</h2>
                            <p class="text-slate-400 text-sm leading-relaxed font-light">
                                Sador's corporate estimators and executive engineers maintain offices in Bole Sub City. Drop in or call for instant consultation.
                            </p>
                        </div>
                        
                        <!-- Details -->
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-sador-orange shrink-0">
                                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-200">Office Location</h4>
                                    <p class="text-slate-400 text-sm mt-1 leading-relaxed">Bole Sub City, Woreda 03,<br>Addis Ababa, Ethiopia</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-sador-orange shrink-0">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-200">Phone Connection</h4>
                                    <p class="text-slate-400 text-sm mt-1">
                                        <a href="tel:+251911000000" class="hover:text-sador-orange transition-colors font-semibold">+251 911 00 00 00</a><br>
                                        <a href="tel:+251116000000" class="hover:text-sador-orange transition-colors font-semibold">+251 11 600 00 00</a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-sador-orange shrink-0">
                                    <i data-lucide="mail-open" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-200">Email Dispatch</h4>
                                    <p class="text-slate-400 text-sm mt-1">
                                        <a href="mailto:info@sadorconstruction.com" class="hover:text-sador-orange transition-colors font-semibold">info@sadorconstruction.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom accreditation footer in block -->
                    <div class="relative z-10 pt-12 border-t border-slate-900 flex items-center gap-3 text-slate-500 text-xs font-semibold">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Estimators Online: 8:00 AM - 5:30 PM</span>
                    </div>
                </div>

                <!-- Contact and Proposal Form -->
                <div class="p-10 lg:p-16 bg-white space-y-8 flex flex-col justify-center">
                    <div class="space-y-2">
                        <h2 class="text-2xl lg:text-3xl font-display font-extrabold text-slate-900">Initiate Estimate Proposal</h2>
                        <p class="text-slate-400 text-sm font-light">Prepare your details below and an engineer will reply within 12 hours.</p>
                    </div>

                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="Abebe Kebede">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Connection</label>
                                <input type="text" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="+251 9...">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="abebe@example.com">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Service Scope Requested</label>
                            <select class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none font-semibold text-slate-700">
                                <option>Commercial Tower Construction</option>
                                <option>Luxury Residential Estates</option>
                                <option>Heavy Civil & Road Infrastructure</option>
                                <option>General Inquiries & Subcontracting</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Brief Description</label>
                            <textarea rows="4" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none placeholder-slate-400" required placeholder="Please describe details like site area, number of stories, target budget..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-white font-display font-extrabold text-xs uppercase tracking-widest py-4.5 rounded-xl transition-all duration-300 shadow-lg shadow-sador-orange/20 flex items-center justify-center gap-2 group">
                            Submit Cost Inquiry Proposal
                            <i data-lucide="send" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Google Map in premium curved framed frame container -->
    <section class="mb-0 bg-slate-50 pb-20">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="w-full h-[450px] rounded-[32px] overflow-hidden border border-slate-200 shadow-2xl relative bg-slate-200" data-aos="fade-up">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m3!1d126115.11523450917!2d38.70678235287515!3d9.01079340621434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85cef5ab402d%3A0x8467b6b037a24d49!2sAddis%20Ababa!5e0!3m2!1sen!2sen!4v1700000000000!5m2!1sen!2sen" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection