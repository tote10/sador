@extends('layouts.main')

@section('title', 'Careers at Sador')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 brightness-[0.55] contrast-[1.2]" 
         style="background-image: url('{{ asset('images/hero-building3.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-10 text-center" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Join Sador</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight">Open Opportunities</h1>
        <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
            Build a monumental career with Ethiopia's premier general construction firm. Explore our active engineering openings below.
        </p>
    </div>
</div>

    <!-- Vacancies List -->
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="space-y-8" x-data="{ openJob: null }">
                @php
                    $jobs = [
                        [
                            'id' => 1,
                            'title' => 'Senior Civil Engineer',
                            'type' => 'Full-Time',
                            'loc' => 'Addis Ababa (Site Operations)',
                            'exp' => '5+ Years Experience',
                            'edu' => 'B.Sc. in Civil Engineering',
                            'sal' => 'Competitive / Neg.',
                            'desc' => 'We are seeking a highly competent Senior Civil Engineer to manage daily site layout, subcontractor operations, safety audits, and material schedules on our high-rise commercial structures.'
                        ],
                        [
                            'id' => 2,
                            'title' => 'Quantity Surveyor & Estimator',
                            'type' => 'Full-Time',
                            'loc' => 'Addis Ababa (Head Office)',
                            'exp' => '3+ Years Experience',
                            'edu' => 'B.Sc. in Quantity Surveying',
                            'sal' => 'Negotiable',
                            'desc' => 'Responsible for architectural blueprint analysis, preparing detailed Bill of Quantities (BOQ), tracking material cost indices, and formulating tender documents for bidding.'
                        ],
                        [
                            'id' => 3,
                            'title' => 'Structural steel Welder / Fitter',
                            'type' => 'Contract',
                            'loc' => 'Hawassa Corridor Site',
                            'exp' => '2+ Years Experience',
                            'edu' => 'TVET Certification',
                            'sal' => 'Competitive',
                            'desc' => 'Executing complex heavy steel alignment, load-bearing welding operations, and ensuring strict adherence to mechanical blueprints and safety precautions on site.'
                        ]
                    ];
                @endphp

                @foreach($jobs as $job)
                <!-- Vacancy Card -->
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-lg hover:shadow-xl hover:border-sador-blue/20 transition-all duration-300 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 group" data-aos="fade-up">
                    <div class="space-y-4 flex-1">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-2xl font-display font-extrabold text-slate-900 group-hover:text-sador-blue transition-colors">
                                {{ $job['title'] }}
                            </h2>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                {{ $job['type'] }}
                            </span>
                        </div>
                        
                        <!-- Metadata Tags -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs text-slate-500 font-semibold border-y border-slate-50 py-3.5">
                            <span class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                                {{ $job['loc'] }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="briefcase" class="w-4 h-4 text-slate-400"></i>
                                {{ $job['exp'] }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-400"></i>
                                {{ $job['edu'] }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="dollar-sign" class="w-4 h-4 text-slate-400"></i>
                                {{ $job['sal'] }}
                            </span>
                        </div>
                        
                        <p class="text-slate-500 text-sm leading-relaxed max-w-3xl">
                            {{ $job['desc'] }}
                        </p>
                    </div>
                    
                    <div class="w-full md:w-auto shrink-0">
                        <a href="/contact?subject=Application for {{ rawurlencode($job['title']) }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-sador-blue to-slate-900 hover:from-sador-orange hover:to-amber-500 text-white w-full md:w-auto px-8 py-4.5 rounded-2xl font-bold text-xs uppercase tracking-wider transition-all duration-300 hover:-translate-y-0.5 shadow-lg group">
                            Apply for Role
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- General Application Widget -->
            <div class="mt-20 bg-slate-900 rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden border border-slate-800" data-aos="zoom-in">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-sador-orange/20 rounded-full filter blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-display font-extrabold mb-3">Don't see your domain listed?</h3>
                        <p class="text-slate-400 text-sm max-w-2xl leading-relaxed">We are constantly recruiting high-potential civil, structural, safety compliance, and estimating experts. Submit your comprehensive portfolio directly.</p>
                    </div>
                    <a href="/contact" class="bg-gradient-to-r from-sador-orange to-amber-500 text-white px-8 py-4.5 rounded-2xl font-bold uppercase tracking-wider text-xs shadow-lg shadow-sador-orange/20 transition-all shrink-0">
                        Submit Open CV
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection