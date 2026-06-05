@extends('layouts.main')

@section('title', 'About Our Legacy')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 contrast-[1.1] brightness-[0.5] z-0" 
         style="background-image: url('{{ asset('images/hero-building1.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/20 to-slate-950/90 z-10"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-20 text-center" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-[10px] mb-4 block">Corporate Heritage</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight text-white">
            Our History & Leadership
        </h1>
        <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
            Building Ethiopia's future with uncompromising engineering standards since 2011.
        </p>
    </div>
</div>
    <!-- History Narrative & Asymmetric Section -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6" data-aos="fade-right">
                    <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs block">Legacy of Trust</span>
                    <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 leading-tight">Decades of Building Masterpieces</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                    The company was established on 2012 E.C As the Owner of company (Eng, Tinsae Fikadu) for the purpose of providing small, medium & large scale General civil construction works. The company was established by an Ethiopian National with the objectives of the company to engage efficiently, responsibly and profitably in a reasonable Profit margin in the construction industry.

                    </p>

                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div class="border-l-4 border-sador-orange pl-4">
                            <div class="text-2xl font-bold text-slate-900 font-display">120+</div>
                            <div class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Projects Completed</div>
                        </div>
                        <div class="border-l-4 border-sador-blue pl-4">
                            <div class="text-2xl font-bold text-slate-900 font-display">Grade-1</div>
                            <div class="text-xs text-slate-400 font-semibold uppercase tracking-wide">General Contractor</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="absolute -inset-2 bg-gradient-to-tr from-sador-blue to-sador-orange rounded-3xl opacity-10 blur-xl"></div>
                    <div class="relative bg-slate-100 rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img src="{{ asset('images/hero-building2.jpg') }}" alt="Construction Work" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Step-by-Step Vertical Timeline -->
    <section class="py-24 bg-slate-50 relative overflow-hidden border-y border-slate-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Corporate Timeline</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Our Path of Growth</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>

            <!-- Vertical Timeline UI -->
            <div class="relative max-w-3xl mx-auto">
                <!-- Center Line -->
                <div class="absolute left-4 sm:left-1/2 transform -translate-x-1/2 w-0.5 h-full bg-slate-200"></div>

                @php
                    $timeline = [
                        ['year' => '2011', 'title' => 'Founding of Sador', 'desc' => 'Started with a select team of dedicated civil contractors, executing residential complexes in Addis Ababa.'],
                        ['year' => '2015', 'title' => 'Upgrade to Class-3 Contractor', 'desc' => 'Obtained larger regional credentials, transitioning into large-scale commercial structures and multi-story warehouses.'],
                        ['year' => '2020', 'title' => 'Grade-1 Licensure Integration', 'desc' => 'Officially accredited as a Class-1 General Contractor in Ethiopia, gaining capacity for heavy municipal works.'],
                        ['year' => '2026', 'title' => 'The Innovation & Tech Era', 'desc' => 'Pioneering structural pre-fabrication, green-building certifications, and tech-driven resource scheduling.']
                    ];
                @endphp

                @foreach($timeline as $i => $item)
                <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between mb-16 sm:even:flex-row-reverse" data-aos="fade-up">
                    <!-- Left empty pane for alignment -->
                    <div class="hidden sm:block w-[45%] text-right sm:group-even:text-left"></div>
                    
                    <!-- Bullet Point dot -->
                    <div class="absolute left-4 sm:left-1/2 transform -translate-x-1/2 w-5 h-5 rounded-full bg-sador-orange border-4 border-white shadow-md z-10"></div>
                    
                    <!-- Content Card -->
                    <div class="w-full sm:w-[45%] pl-12 sm:pl-0">
                        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/60 hover:shadow-2xl transition-all duration-300 relative group">
                            <!-- Absolute Year Badge -->
                            <span class="absolute -top-4 left-6 bg-sador-blue text-white text-xs font-bold px-4 py-1.5 rounded-xl shadow-md">
                                {{ $item['year'] }}
                            </span>
                            <h3 class="text-xl font-bold text-slate-900 mt-2 mb-3">{{ $item['title'] }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vision, Mission, Values -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Our Vision</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                To become the most reliable construction partner in the construction industry by 2030, recognized for delivering high-quality services with scheduled time frame, while maintaining a safe Environment record
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="target" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Our Mission</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                Our mission is to deliver high-quality Services through proper resources management and skilled craftsmanship. We commit to completing projects on time and within budget, reducing resource waste and client satisfaction.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="gem" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Core Values</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                S-Safety First
                <br>
                A-Accountability
                <br>
                D-Diligence
                <br>
                O-Operational Excellence
                <br>
                R-Reliability
                </p>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-4 max-w-7xl text-center">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Expert Team</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Executive Board & Partners</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $team = [
                        ['name' => 'Eng. Tinsae Fikadu', 'role' => 'C0-Founder, GM', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop'],
                        ['name' => 'Eng. Mintesinot', 'role' => 'Contractor', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop']
                    ];
                @endphp

                @foreach($team as $i => $t)
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="relative aspect-[4/5] bg-slate-100 overflow-hidden">
                        <img src="{{ $t['img'] }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-display font-extrabold text-slate-900 text-lg leading-tight">{{ $t['name'] }}</h4>
                        <span class="text-sador-orange text-xs font-semibold block mt-2 uppercase tracking-wider">{{ $t['role'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection