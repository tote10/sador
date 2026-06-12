@extends('layouts.main')

@section('title', 'Engineering & Construction Services')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 brightness-[0.5] contrast-[1.1] z-0" 
         style="background-image: url('{{ asset('images/hero-building4.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/20 to-slate-950/90 z-10"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-20 text-center" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-[10px] mb-4 block">Our Core Capabilities</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight">Engineering Solutions</h1>
        <p class="text-lg md:text-xl text-white max-w-2xl mx-auto font-medium leading-relaxed drop-shadow-md">
            Executing complex commercial, luxury residential, and heavy civil infrastructure works with engineering precision.
        </p>
    </div>
</div>

    <!-- Services Catalog List -->
    <section class="py-24 bg-slate-50 relative">
        <div class="container mx-auto px-4 max-w-7xl space-y-24">

            @foreach($services as $i => $serv)
            @php
                // Map icon
                $icon = 'building-2';
                if (str_contains(strtolower($serv->slug), 'residential') || str_contains(strtolower($serv->title), 'residential')) {
                    $icon = 'home';
                } elseif (str_contains(strtolower($serv->slug), 'civil') || str_contains(strtolower($serv->slug), 'infrastructure') || str_contains(strtolower($serv->title), 'infrastructure') || str_contains(strtolower($serv->title), 'civil')) {
                    $icon = 'milestone';
                }

                // Map badge
                $badge = 'Grade-1 Certified';
                if (str_contains(strtolower($serv->slug), 'residential') || str_contains(strtolower($serv->title), 'residential')) {
                    $badge = 'Bespoke Luxury';
                } elseif (str_contains(strtolower($serv->slug), 'civil') || str_contains(strtolower($serv->slug), 'infrastructure') || str_contains(strtolower($serv->title), 'infrastructure') || str_contains(strtolower($serv->title), 'civil')) {
                    $badge = 'National Priority';
                }

                // Map bullets
                $bullets = [];
                if (str_contains(strtolower($serv->slug), 'commercial') || str_contains(strtolower($serv->title), 'commercial')) {
                    $bullets = [
                        'Turnkey project management & procurement',
                        'Advanced seismic & wind code compliance',
                        'LEED-certified sustainable materials option'
                    ];
                } elseif (str_contains(strtolower($serv->slug), 'residential') || str_contains(strtolower($serv->title), 'residential')) {
                    $bullets = [
                        'Bespoke interior architectural blueprints',
                        'Energy-efficient dynamic cooling & systems',
                        'Absolute timeline adherence & fast handover'
                    ];
                } else {
                    $bullets = [
                        'State-of-the-art grading & compaction machinery',
                        'Rigorous highway compaction load tests',
                        'Approved federal & municipal contractor status'
                    ];
                }
            @endphp
            <!-- Service Catalog Item -->
            <div class="bg-white rounded-[32px] overflow-hidden border border-slate-100/80 shadow-2xl flex flex-col {{ $i % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-stretch min-h-[500px]" data-aos="fade-up">
                <!-- Image Side -->
                <div class="lg:w-1/2 relative bg-slate-200 min-h-[300px] lg:min-h-full overflow-hidden">
                    <img src="{{ $serv->image_url }}" alt="{{ $serv->title }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" loading="lazy">
                    <div class="absolute inset-0 bg-slate-950/20"></div>
                    <span class="absolute top-6 left-6 bg-sador-blue text-white text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-xl shadow-lg">
                        {{ $badge }}
                    </span>
                </div>
                
                <!-- Content Side -->
                <div class="lg:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-sador-orange/5 text-sador-orange flex items-center justify-center">
                            <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-display font-extrabold text-slate-900 leading-tight">
                            {{ $serv->title }}
                        </h2>
                    </div>
                    
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ $serv->full_description }}
                    </p>
                    
                    <!-- Specifications list -->
                    <ul class="space-y-3.5 pt-2 border-t border-slate-100">
                        @foreach($bullets as $bullet)
                        <li class="flex items-center gap-3 text-sm text-slate-700 font-semibold">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-sador-orange shrink-0"></i>
                            <span>{{ $bullet }}</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <!-- Call Action -->
                    <div class="pt-4">
                        <a href="/contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-sador-blue to-slate-900 hover:from-sador-orange hover:to-amber-500 text-white px-8 py-4.5 rounded-2xl text-xs font-bold uppercase tracking-wider transition-all duration-300 hover:-translate-y-0.5 shadow-lg group">
                            Inquire for Project
                            <i data-lucide="send" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>

    <!-- Accreditation & Custom Estimate Section -->
    <section class="py-24 bg-slate-950 text-white overflow-hidden relative">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_30%,#FF6600_0%,transparent_55%)] opacity-10"></div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="max-w-4xl mx-auto text-center space-y-8" data-aos="zoom-in">
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold">Need a highly detailed technical feasibility study?</h2>
                <p class="text-slate-400 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
                    Sador's senior executive estimator board is ready to analyze your bill of quantities (BOQ) or architectural sketches and deliver custom cost estimations.
                </p>
                <div class="flex justify-center gap-4 pt-4">
                    <a href="/contact" class="bg-gradient-to-r from-sador-orange to-amber-500 text-white px-10 py-5 rounded-2xl font-bold text-sm uppercase tracking-widest shadow-xl shadow-sador-orange/20 transition-all">
                        Initiate Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection