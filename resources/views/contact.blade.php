@extends('layouts.main')

@section('title', 'Get in Touch with Our Engineers')
@section('meta_description', 'Contact Sador General Construction in Addis Ababa for project estimates, feasibility surveys and career enquiries. Call +251 911 708175 or email Sadorgcsador@gmail.com.')

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
            Whether you need a project estimate, a feasibility survey, or career details, our engineers are here to assist.
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
                                    <p class="text-slate-400 text-sm mt-1 leading-relaxed">{{ $settings['company_address'] ?? 'ADDISABABA, ALEMNESH plaza building 13TH floor, Room No.1303' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-sador-orange shrink-0">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-200">Phone Connection</h4>
                                    <p class="text-slate-400 text-sm mt-1">
                                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $settings['whatsapp_number'] ?? '+251911708175') }}" class="hover:text-sador-orange transition-colors font-semibold">{{ $settings['company_phone'] ?? '+2519 11 70 81 75 / +2519 76 80 80 76' }}</a>
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
                                        <a href="mailto:{{ $settings['company_email'] ?? 'Sadorgcsador@gmail.com' }}" class="hover:text-sador-orange transition-colors font-semibold">{{ $settings['company_email'] ?? 'Sadorgcsador@gmail.com' }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom accreditation footer in block -->
                    <div class="relative z-10 pt-12 border-t border-slate-900 flex items-center gap-3 text-slate-500 text-xs font-semibold">
                        <span>{{ $settings['working_hours'] ?? 'Mon - Sat: 8:00 AM - 5:30 PM' }}</span>
                    </div>
                </div>

                <!-- Contact and Proposal Form -->
                <div class="p-10 lg:p-16 bg-white space-y-8 flex flex-col justify-center">
                    <div class="space-y-2">
                        <h2 class="text-2xl lg:text-3xl font-display font-extrabold text-slate-900">Initiate Estimate Proposal</h2>
                        <p class="text-slate-400 text-sm font-light">Prepare your details below and an engineer will reply within 12 hours.</p>
                    </div>

                    @if(session('success'))
                        <div class="p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 text-xs font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text" name="name" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="Abebe Kebede" value="{{ old('name') }}">
                                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Connection</label>
                                <input type="text" name="phone" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="+251 9..." value="{{ old('phone') }}">
                                @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" name="email" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" required placeholder="abebe@example.com" value="{{ old('email') }}">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Service Scope Requested</label>
                            <select name="service_requested" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none font-semibold text-slate-700">
                                <option value="Commercial Towers">Commercial Tower Construction</option>
                                <option value="Residential Estates">Luxury Residential Estates</option>
                                <option value="Civil Infrastructure">Heavy Civil & Road Infrastructure</option>
                                <option value="General Inquiries">General Inquiries & Subcontracting</option>
                            </select>
                            @error('service_requested') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Brief Description</label>
                            <textarea name="message" rows="4" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none placeholder-slate-400" required placeholder="Please describe details like site area, number of stories, target budget...">{{ old('message') }}</textarea>
                            @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <button type="submit" 
                                :disabled="submitting"
                                :class="submitting ? 'opacity-80 cursor-not-allowed scale-[0.99]' : 'hover:scale-[1.01] hover:shadow-xl hover:shadow-sador-orange/30 active:scale-[0.98]'"
                                class="w-full bg-gradient-to-r from-sador-orange to-amber-500 text-white font-display font-extrabold text-xs uppercase tracking-widest py-4 rounded-xl transition-all duration-300 shadow-lg shadow-sador-orange/20 flex items-center justify-center gap-2 group">
                            <span x-show="!submitting" class="flex items-center justify-center gap-2">
                                Submit Cost Inquiry Proposal
                                <i data-lucide="send" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                            </span>
                            <span x-show="submitting" class="flex items-center justify-center gap-2" style="display: none;">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending cost proposal...
                            </span>
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
                <iframe src="{{ $settings['google_maps_embed'] ?? 'https://maps.google.com/maps?q=Alemnesh%20Plaza,%20Bole,%20Addis%20Ababa,%20Ethiopia&t=&z=16&ie=UTF8&iwloc=&output=embed' }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection