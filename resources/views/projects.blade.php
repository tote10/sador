@extends('layouts.main')

@section('title', 'Our Architectural & Infrastructure Portfolio')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 brightness-[0.6] contrast-[1.1] z-0" 
         style="background-image: url('{{ asset('images/hero-building2.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-transparent to-slate-950/90 z-10"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-20" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Engineering Monuments</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight">Our Flagship Projects</h1>
        <p class="text-lg md:text-xl text-slate-300 max-w-2xl font-light leading-relaxed">
            Exploring Sador's portfolio of completed and active mixed-use commercial towers, luxury estates, and municipal asphalt paving works.
        </p>
    </div>
</div>

    @php
        $projects = array_values(App\Helpers\ProjectHelper::getAll());
    @endphp

    <!-- Projects Grid Section with Alpine.js Filtering -->
    <section class="py-24 bg-slate-50" 
             x-data="{ 
                 activeCategory: 'all',
                 activeYear: 'all',
                 activeLocation: 'all',
                 projects: {{ json_encode(array_map(function($p) { return ['cat' => $p['cat'], 'year' => $p['year'], 'loc' => $p['loc_filter']]; }, $projects)) }},
                 hasMatches() {
                     return this.projects.some(p => 
                         (this.activeCategory === 'all' || this.activeCategory === p.cat) &&
                         (this.activeYear === 'all' || this.activeYear === p.year) &&
                         (this.activeLocation === 'all' || this.activeLocation === p.loc)
                     );
                 }
             }">
        <div class="container mx-auto px-4 max-w-7xl">
            
            <!-- Dynamic Filters Bar -->
            <div class="bg-white rounded-[32px] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 mb-16 flex flex-col lg:flex-row lg:items-center justify-between gap-6" data-aos="fade-up">
                <!-- Category Buttons (Left) -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mr-2 lg:block hidden">
                        Category:
                    </span>
                    <button @click="activeCategory = 'all'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 focus:outline-none"
                            :class="activeCategory === 'all' ? 'bg-sador-blue text-white shadow-lg shadow-sador-blue/20' : 'bg-slate-50 hover:bg-slate-100 text-slate-600'">
                        All
                    </button>
                    <button @click="activeCategory = 'commercial'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 focus:outline-none"
                            :class="activeCategory === 'commercial' ? 'bg-sador-blue text-white shadow-lg shadow-sador-blue/20' : 'bg-slate-50 hover:bg-slate-100 text-slate-600'">
                        Commercial
                    </button>
                    <button @click="activeCategory = 'residential'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 focus:outline-none"
                            :class="activeCategory === 'residential' ? 'bg-sador-blue text-white shadow-lg shadow-sador-blue/20' : 'bg-slate-50 hover:bg-slate-100 text-slate-600'">
                        Residential
                    </button>
                    <button @click="activeCategory = 'infrastructure'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 focus:outline-none"
                            :class="activeCategory === 'infrastructure' ? 'bg-sador-blue text-white shadow-lg shadow-sador-blue/20' : 'bg-slate-50 hover:bg-slate-100 text-slate-600'">
                        Infrastructure
                    </button>
                </div>

                <!-- Dropdowns & Reset Button (Right) -->
                <div class="flex flex-wrap items-end gap-4 w-full lg:w-auto">
                    <!-- Location Filter Dropdown -->
                    <div class="relative w-full sm:w-44" x-data="{ open: false }" @click.outside="open = false">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 ml-1">Location</span>
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-100 transition-all">
                            <span x-text="activeLocation === 'all' ? 'All Locations' : (activeLocation === 'addis-ababa' ? 'Addis Ababa' : (activeLocation === 'hawassa' ? 'Hawassa' : 'Adama'))">All Locations</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute left-0 right-0 mt-2 bg-white border border-slate-100 shadow-xl rounded-2xl p-2 z-30 space-y-1"
                             style="display: none;">
                            <button @click="activeLocation = 'all'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeLocation === 'all' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">All Locations</button>
                            <button @click="activeLocation = 'addis-ababa'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeLocation === 'addis-ababa' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">Addis Ababa</button>
                            <button @click="activeLocation = 'hawassa'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeLocation === 'hawassa' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">Hawassa</button>
                            <button @click="activeLocation = 'adama'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeLocation === 'adama' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">Adama</button>
                        </div>
                    </div>

                    <!-- Year Filter Dropdown -->
                    <div class="relative w-full sm:w-44" x-data="{ open: false }" @click.outside="open = false">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1.5 ml-1">Year</span>
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-100 transition-all">
                            <span x-text="activeYear === 'all' ? 'All Years' : activeYear">All Years</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                             class="absolute left-0 right-0 mt-2 bg-white border border-slate-100 shadow-xl rounded-2xl p-2 z-30 space-y-1"
                             style="display: none;">
                            <button @click="activeYear = 'all'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeYear === 'all' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">All Years</button>
                            <button @click="activeYear = '2023'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeYear === '2023' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">2023</button>
                            <button @click="activeYear = '2024'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeYear === '2024' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">2024</button>
                            <button @click="activeYear = '2025'; open = false" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors" :class="activeYear === '2025' ? 'text-sador-blue font-bold bg-sador-blue/5' : 'text-slate-600'">2025</button>
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <button x-show="activeCategory !== 'all' || activeLocation !== 'all' || activeYear !== 'all'"
                            @click="activeCategory = 'all'; activeLocation = 'all'; activeYear = 'all'"
                            class="w-full sm:w-auto px-5 py-3 bg-red-50 hover:bg-red-100 text-red-500 rounded-xl transition-all text-xs font-bold uppercase tracking-wider flex items-center justify-center gap-2 border border-red-100"
                            style="display: none;">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Dynamic grid items -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($projects as $index => $proj)
                <a href="/projects/{{ $proj['slug'] }}"
                     x-show="(activeCategory === 'all' || activeCategory === '{{ $proj['cat'] }}') && (activeYear === 'all' || activeYear === '{{ $proj['year'] }}') && (activeLocation === 'all' || activeLocation === '{{ $proj['loc_filter'] }}')"
                     x-transition:enter="transition ease-out duration-400 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-300 transform"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                     class="bg-white rounded-[32px] overflow-hidden border border-slate-100 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 group block" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 50 }}">
                     
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-200">
                        <img src="{{ $proj['src'] }}" alt="{{ $proj['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-slate-950/0 group-hover:bg-slate-950/45 transition-colors duration-300"></div>
                        <div class="absolute top-4 left-4 bg-gradient-to-r from-sador-orange to-amber-500 text-white text-[10px] font-extrabold uppercase tracking-widest px-3.5 py-1.5 rounded-lg shadow-md">
                            {{ $proj['cat_label'] }}
                        </div>
                        <span class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="w-14 h-14 rounded-full bg-white/90 text-slate-900 flex items-center justify-center shadow-xl opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 transition-all duration-300">
                                <i data-lucide="eye" class="w-7 h-7"></i>
                            </span>
                        </span>
                    </div>
                    
                    <div class="p-8">
                        <span class="text-sador-orange text-[10px] font-extrabold uppercase tracking-widest block mb-2">{{ $proj['cat_label'] }}</span>
                        <h3 class="text-2xl font-display font-extrabold text-slate-900 group-hover:text-sador-blue transition-colors leading-tight mb-6">
                            {{ $proj['title'] }}
                        </h3>
                        
                        <div class="flex flex-col gap-3.5 text-xs text-slate-500 font-semibold border-t border-slate-100 pt-6">
                            <div class="flex items-center gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                <span>{{ $proj['loc'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="calendar" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                <span>Completed: {{ $proj['year'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="gauge" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                <span>Scope: {{ $proj['scale'] }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Empty State Alert for no search matches -->
            <div x-show="!hasMatches()" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 y-4"
                 x-transition:enter-end="opacity-100 y-0"
                 class="text-center py-20 bg-white rounded-3xl border border-slate-100 mt-10"
                 style="display: none;">
                <i data-lucide="folder-open" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                <h4 class="text-lg font-bold text-slate-800">No Projects Found</h4>
                <p class="text-slate-400 text-sm mt-1">Try resetting the filter options above.</p>
            </div>
            
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="bg-slate-950 py-20 relative overflow-hidden text-white border-t border-slate-900">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,#003087_0%,transparent_50%)] opacity-20"></div>
        <div class="container mx-auto px-4 max-w-7xl flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8 relative z-10">
            <div>
                <h2 class="text-3xl font-display font-extrabold mb-3">Have a corporate grading proposal?</h2>
                <p class="text-slate-400 font-light text-lg">Let Sador's board of constructors prepare your technical bid feasibility study.</p>
            </div>
            <a href="/contact" class="bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-white px-10 py-5 rounded-2xl font-bold uppercase tracking-widest text-xs shadow-xl shadow-sador-orange/20 transition-all shrink-0">
                Start Feasibility Conversation
            </a>
        </div>
    </section>
@endsection