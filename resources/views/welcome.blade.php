@extends('layouts.main')

@section('title', 'Leading Construction & Infrastructure in Ethiopia')
@section('meta_description', 'Sador General Construction builds commercial towers, residential complexes and civil infrastructure across Ethiopia — delivered on time, on budget, and to the highest safety standards.')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-slate-950 text-white min-h-screen flex items-center pt-24 overflow-hidden"
             x-data="{ 
                 activeSlide: 0,
                 slides: [
                     '{{ asset('images/hero-building1.jpg') }}',
                     '{{ asset('images/hero-building2.jpg') }}',
                     '{{ asset('images/hero-building3.jpg') }}',
                     '{{ asset('images/hero-building4.jpg') }}'
                 ]
             }"
             x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)">
        
        <!-- Background Image Slideshow with horizontal slide transition -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform"
                     x-show="activeSlide === index"
                     x-transition:enter="transition-all duration-1000 ease-out"
                     x-transition:enter-start="translate-x-full opacity-0"
                     x-transition:enter-end="translate-x-0 opacity-40"
                     x-transition:leave="transition-all duration-1000 ease-in"
                     x-transition:leave-start="translate-x-0 opacity-40"
                     x-transition:leave-end="-translate-x-full opacity-0"
                     style="display: none;">
                    <img :src="slide" class="w-full h-full object-cover animate-pulse" style="animation-duration: 4s;" alt="Sador Construction Site Showcase">
                </div>
            </template>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent z-10"></div>
        </div>
        
        <!-- Atmospheric glowing ambient blobs -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-sador-blue/20 rounded-full filter blur-[100px] animate-blob-float"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-sador-orange/10 rounded-full filter blur-[120px] animate-blob-float animation-delay-2000"></div>
        
        <div class="container mx-auto px-4 max-w-7xl z-10 relative">
            <div class="max-w-4xl" data-aos="fade-right">
                <!-- Glowing Live Badge -->                
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-display font-bold tracking-tight text-white mb-6">
                We Construct Engineering Masterpieces
                </h1>
                
                <p class="text-lg md:text-xl text-slate-300 mb-12 font-light leading-relaxed max-w-3xl">
                At Sador General Construction, we believe that every great structure is built on a foundation of reliability and integrity.
                And, we know that every project begins with a vision. That's why we treat your project like it's our own.
                <br>
                <span class="text-sador-orange font-bold">"Your Vision, Our Mission"</span>

                </p>
                
                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="/projects" class="bg-gradient-to-r from-sador-orange to-amber-500 text-white px-10 py-5 rounded-2xl font-bold text-center hover:opacity-95 transform hover:-translate-y-0.5 transition-all duration-300 shadow-xl shadow-sador-orange/20 flex items-center justify-center gap-2 group">
                        Explore Our Portfolio
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="/contact" class="bg-slate-900/60 backdrop-blur-md border border-slate-800 text-white px-10 py-5 rounded-2xl font-bold text-center hover:bg-white hover:text-slate-950 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                        Contact Us
                        <i data-lucide="mail" class="w-5 h-5 opacity-60"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slider Indicators (Sleek Dots on Bottom Right) -->
        <div class="absolute bottom-12 right-12 z-20 flex items-center gap-2.5">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                        :class="activeSlide === index ? 'w-8 bg-sador-orange' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
            </template>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="why-choose-us" class="py-28 bg-slate-50 relative overflow-hidden">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 opacity-2" style="background-image: radial-gradient(#003087 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Corporate Purity</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6 leading-tight">Excellence Engineered in Every Process</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Why Card 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/80 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-sador-blue/5 text-sador-blue rounded-2xl flex items-center justify-center mb-8 group-hover:bg-sador-blue group-hover:text-white transition-all duration-500 group-hover:rotate-6">
                        <i data-lucide="history" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">15+ Yrs Leadership</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Delivering major corporate, civil and government building contracts across Ethiopia with exceptional consistency.</p>
                </div>

                <!-- Why Card 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/80 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-sador-blue/5 text-sador-blue rounded-2xl flex items-center justify-center mb-8 group-hover:bg-sador-blue group-hover:text-white transition-all duration-500 group-hover:rotate-6">
                        <i data-lucide="gem" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Premium Materials</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Sourcing only high-grade certified concrete, structural steel, and luxurious architectural finishes.</p>
                </div>

                <!-- Why Card 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/80 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-sador-blue/5 text-sador-blue rounded-2xl flex items-center justify-center mb-8 group-hover:bg-sador-blue group-hover:text-white transition-all duration-500 group-hover:rotate-6">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Timeline Guarantee</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Adhering strictly to modern critical-path scheduling to guarantee on-time structural delivery.</p>
                </div>

                <!-- Why Card 4 -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/80 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-14 h-14 bg-sador-blue/5 text-sador-blue rounded-2xl flex items-center justify-center mb-8 group-hover:bg-sador-blue group-hover:text-white transition-all duration-500 group-hover:rotate-6">
                        <i data-lucide="users-2" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Certified Engineers</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">A specialized workforce consisting of heavily vetted, board-certified civil and structural experts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="py-28 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-20" data-aos="fade-up">
                <div class="max-w-2xl">
                    <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Our Core Domains</span>
                    <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Innovative Civil & Structural Solutions</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 rounded-full"></div>
                </div>
                <div class="mt-8 lg:mt-0">
                    <a href="/services" class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-sador-orange transition-colors shadow-lg shadow-slate-950/5 group">
                        Browse Services
                        <i data-lucide="arrow-up-right" class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($services as $serv)
                <div class="group bg-slate-50 rounded-3xl overflow-hidden border border-slate-100 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-200">
                        <img src="{{ $serv->image_url }}" alt="{{ $serv->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                        @if ($serv->is_featured)
                        <span class="absolute top-4 left-4 bg-sador-blue text-white text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-md">
                            Featured
                        </span>
                        @endif
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-sador-blue transition-colors">{{ $serv->title }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8">{{ $serv->short_description }}</p>
                        <a href="/services" class="inline-flex items-center gap-2 text-xs font-bold text-sador-blue group-hover:text-sador-orange transition-colors uppercase tracking-widest font-display">
                            Learn More 
                            <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Projects Grid -->
    <section class="py-28 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Corporate Showcase</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Our Flagship Projects</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($featuredProjects as $proj)
                <div class="bg-white rounded-3xl overflow-hidden hover:-translate-y-2.5 transition-all duration-500 group border border-slate-100 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative aspect-[4/3] overflow-hidden bg-slate-200">
                        <img src="{{ $proj->cover_url }}" alt="{{ $proj->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" loading="lazy">
                        <div class="absolute top-4 left-4 bg-gradient-to-r from-sador-orange to-amber-500 text-white text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-md">
                            {{ ucfirst($proj->category) }}
                        </div>
                        <div class="absolute inset-0 bg-slate-950/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-8">
                            <span class="text-sador-orange text-xs font-bold uppercase tracking-widest mb-2">{{ ucfirst($proj->category) }}</span>
                            <h4 class="text-white text-2xl font-display font-bold mb-4">{{ $proj->title }}</h4>
                            <p class="text-slate-300 text-xs mb-6 flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-sador-orange"></i> {{ $proj->location }}</p>
                            <a href="/projects/{{ $proj->slug }}" class="inline-flex items-center gap-2 bg-sador-orange text-white text-xs font-bold uppercase tracking-wider px-5 py-3 rounded-xl hover:bg-orange-600 transition-colors w-fit">
                                View Details <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 flex justify-between items-center border-t border-slate-50">
                        <a href="/projects/{{ $proj->slug }}" class="block">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-sador-blue transition-colors">{{ $proj->title }}</h3>
                            <p class="text-slate-400 text-xs mt-1 flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-300"></i> {{ $proj->location }}</p>
                        </a>
                        <a href="/projects/{{ $proj->slug }}" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                            <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- CTA Details Portal -->
            <div class="mt-16 text-center">
                <a href="/projects" class="inline-flex items-center gap-3 bg-gradient-to-r from-sador-blue to-slate-900 text-white px-10 py-4.5 rounded-2xl font-bold uppercase tracking-widest text-xs hover:from-sador-orange hover:to-amber-500 hover:-translate-y-0.5 shadow-xl transition-all duration-300">
                    Explore Complete Portfolio
                </a>
            </div>
        </div>
    </section>
    
    <!-- Experience Stats -->
    <section class="py-24 bg-slate-950 relative overflow-hidden text-white">
        <!-- Abstract gradient mesh -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,#003087_0%,transparent_50%)] opacity-30"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_70%,#FF6600_0%,transparent_50%)] opacity-20"></div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-800">
                <div data-aos="zoom-in" data-aos-delay="100" class="pt-8 lg:pt-0 lg:px-4">
                    <div class="text-5xl md:text-7xl font-display font-extrabold text-white mb-3 tracking-tight">
                        {{ $settings['years_experience'] ?? '15' }}<span class="text-sador-orange font-bold">+</span>
                    </div>
                    <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">Years Industry Dominance</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="200" class="pt-8 lg:pt-0 lg:px-4">
                    <div class="text-5xl md:text-7xl font-display font-extrabold text-white mb-3 tracking-tight">
                        {{ $settings['projects_completed'] ?? '15' }}<span class="text-sador-orange font-bold">+</span>
                    </div>
                    <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">Major Handed-Over Projects</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300" class="pt-8 lg:pt-0 lg:px-4">
                    <div class="text-5xl md:text-7xl font-display font-extrabold text-white mb-3 tracking-tight">
                        {{ $settings['happy_clients'] ?? '85' }}<span class="text-sador-orange font-bold">+</span>
                    </div>
                    <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">Prestigious Happy Corporate Clients</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="400" class="pt-8 lg:pt-0 lg:px-4">
                    <div class="text-5xl md:text-7xl font-display font-extrabold text-white mb-3 tracking-tight">
                        {{ $settings['professional_staff'] ?? '300' }}<span class="text-sador-orange font-bold">+</span>
                    </div>
                    <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest">In-house Professional Staff</div>
                </div>
            </div>
        </div>
    </section>

    @if($awards->count())
    <!-- Awards & Recognitions -->
    <section class="py-28 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Milestones of Excellence</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Awards & Recognitions</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($awards as $awd)
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 hover:shadow-xl hover:border-sador-orange/20 transition-all duration-300 text-center group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="w-14 h-14 bg-amber-500/10 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        @if ($awd->logo_url)
                            <img src="{{ $awd->logo_url }}" class="w-8 h-8 object-contain" alt="{{ $awd->title }}">
                        @else
                            <i data-lucide="award" class="w-7 h-7"></i>
                        @endif
                    </div>
                    <span class="text-slate-400 text-xs font-bold block mb-2">{{ $awd->year }}</span>
                    <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-sador-blue transition-colors">{{ $awd->title }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">{{ $awd->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Slider Section -->
    <section class="py-28 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Client Testimonials</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Trusted by Major Developers</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>

            <!-- Alpine.js Dynamic Testimonial Carousel -->
            <div x-data="{ 
                active: 0,
                testimonials: @js($testimonials->map(fn($t) => [
                    'name' => $t->client_name,
                    'role' => $t->position,
                    'quote' => $t->quote,
                    'rating' => $t->rating,
                    'avatar' => $t->photo_url
                ])),
                next() { this.active = (this.active + 1) % this.testimonials.length },
                prev() { this.active = (this.active - 1 + this.testimonials.length) % this.testimonials.length },
                autoplayInterval: null
            }"
            x-init="autoplayInterval = setInterval(() => { next() }, 6000)"
            @mouseenter="clearInterval(autoplayInterval)"
            @mouseleave="autoplayInterval = setInterval(() => { next() }, 6000)"
            class="relative max-w-4xl mx-auto"
            data-aos="fade-up">
                
                <!-- Slide Container -->
                <div class="relative overflow-hidden bg-slate-50 border border-slate-100 rounded-3xl px-8 py-12 md:p-16 shadow-xl shadow-slate-200/40 min-h-[380px] flex items-center">
                    <!-- Giant Quote Watermark -->
                    <span class="absolute top-10 left-10 text-slate-200 text-9xl font-serif select-none pointer-events-none line-height-none opacity-40">“</span>
                    
                    <div class="relative z-10 w-full">
                        <template x-for="(t, index) in testimonials" :key="index">
                            <div x-show="active === index"
                                 x-transition:enter="transition ease-out duration-500 transform"
                                 x-transition:enter-start="opacity-0 translate-x-12"
                                 x-transition:enter-end="opacity-100 translate-x-0"
                                 x-transition:leave="transition ease-in duration-300 absolute"
                                 x-transition:leave-start="opacity-100 translate-x-0"
                                 x-transition:leave-end="opacity-0 -translate-x-12"
                                 class="space-y-8">
                                
                                <!-- Rating Stars -->
                                <div class="flex items-center gap-1 text-amber-500">
                                    <template x-for="i in t.rating">
                                        <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                                    </template>
                                </div>
                                
                                <!-- Quote text -->
                                <p class="text-lg md:text-xl text-slate-700 italic leading-relaxed font-light" x-text="t.quote"></p>
                                
                                <!-- Author Bio -->
                                <div class="flex items-center gap-4 pt-4">
                                    <template x-if="t.avatar">
                                        <img :src="t.avatar" :alt="t.name" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md" loading="lazy">
                                    </template>
                                    <template x-if="!t.avatar">
                                        <div class="w-14 h-14 rounded-full bg-sador-blue/10 text-sador-blue flex items-center justify-center font-bold text-lg border-2 border-white shadow-md" x-text="t.name ? t.name.charAt(0) : '★'"></div>
                                    </template>
                                    <div>
                                        <h4 class="font-bold text-slate-900" x-text="t.name"></h4>
                                        <p class="text-xs text-slate-400 font-semibold" x-text="t.role"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Manual Navigation Bullets -->
                <div class="flex justify-center items-center gap-3 mt-8">
                    <button @click="prev()" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-sador-blue hover:text-white transition-colors duration-300">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <template x-for="(t, index) in testimonials" :key="index">
                            <button @click="active = index" 
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="active === index ? 'w-8 bg-sador-orange' : 'w-2 bg-slate-300 hover:bg-slate-400'"></button>
                        </template>
                    </div>
                    <button @click="next()" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-sador-blue hover:text-white transition-colors duration-300">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence & Partnerships -->
    <section class="py-28 bg-slate-50 relative overflow-hidden border-t border-slate-100 text-slate-900">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#003087 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Trusted Nationwide</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900">The Confidence of Hundreds</h2>
                <p class="text-slate-500 text-sm mt-4 font-light font-sans">From regional real estate giants to state engineering authorities, Sador is backed by the trust of hundreds of local and international developers.</p>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full mt-6"></div>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16 text-center">
                <!-- Partner Card -->
                <div class="bg-white border border-slate-200/80 p-8 rounded-3xl flex flex-col items-center justify-center shadow-lg shadow-slate-200/40 group hover:border-sador-orange/30 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <i data-lucide="building-2" class="w-8 h-8 text-sador-blue mb-3 group-hover:text-sador-orange group-hover:scale-110 transition-all duration-300"></i>
                    <h4 class="font-extrabold tracking-wider text-sm text-slate-900">NOAH DEVELOPERS</h4>
                    <span class="text-slate-400 text-[10px] uppercase font-bold mt-1">Real Estate Partner</span>
                </div>
                <!-- Partner Card -->
                <div class="bg-white border border-slate-200/80 p-8 rounded-3xl flex flex-col items-center justify-center shadow-lg shadow-slate-200/40 group hover:border-sador-orange/30 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <i data-lucide="home" class="w-8 h-8 text-sador-blue mb-3 group-hover:text-sador-orange group-hover:scale-110 transition-all duration-300"></i>
                    <h4 class="font-extrabold tracking-wider text-sm text-slate-900">GIFT REAL ESTATE</h4>
                    <span class="text-slate-400 text-[10px] uppercase font-bold mt-1">Luxury Contractor Partner</span>
                </div>
                <!-- Partner Card -->
                <div class="bg-white border border-slate-200/80 p-8 rounded-3xl flex flex-col items-center justify-center shadow-lg shadow-slate-200/40 group hover:border-sador-orange/30 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <i data-lucide="route" class="w-8 h-8 text-sador-blue mb-3 group-hover:text-sador-orange group-hover:scale-110 transition-all duration-300"></i>
                    <h4 class="font-extrabold tracking-wider text-sm text-slate-900">FEDERAL ROAD AUTHORITY</h4>
                    <span class="text-slate-400 text-[10px] uppercase font-bold mt-1">Civil Infrastructure Client</span>
                </div>
                <!-- Partner Card -->
                <div class="bg-white border border-slate-200/80 p-8 rounded-3xl flex flex-col items-center justify-center shadow-lg shadow-slate-200/40 group hover:border-sador-orange/30 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                    <i data-lucide="scroll" class="w-8 h-8 text-sador-blue mb-3 group-hover:text-sador-orange group-hover:scale-110 transition-all duration-300"></i>
                    <h4 class="font-extrabold tracking-wider text-sm text-slate-900">MINISTRY OF URBAN DEV</h4>
                    <span class="text-slate-400 text-[10px] uppercase font-bold mt-1">Government Contracting</span>
                </div>
            </div>

            <!-- Trust / Certification Badges -->
            <div class="border-t border-slate-200 pt-16 grid grid-cols-1 md:grid-cols-3 gap-8 items-center text-center md:text-left">
                <div class="flex items-center gap-4 justify-center md:justify-start">
                    <div class="w-12 h-12 bg-sador-blue/5 rounded-2xl flex items-center justify-center shrink-0 text-sador-orange">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">100% Insured Operations</h4>
                        <p class="text-slate-500 text-xs mt-0.5 font-light">Comprehensive liability coverage for all civil projects.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 justify-center md:justify-start">
                    <div class="w-12 h-12 bg-sador-blue/5 rounded-2xl flex items-center justify-center shrink-0 text-sador-orange">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">ISO Certified Quality</h4>
                        <p class="text-slate-500 text-xs mt-0.5 font-light">Adhering strictly to international ISO 9001 blueprints.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 justify-center md:justify-start">
                    <div class="w-12 h-12 bg-sador-blue/5 rounded-2xl flex items-center justify-center shrink-0 text-sador-orange">
                        <i data-lucide="hard-hat" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Zero Site Incidents Rating</h4>
                        <p class="text-slate-500 text-xs mt-0.5 font-light">Voted top HSE safety metrics contractor multiple times.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Dynamic Call To Action -->
    <section class="relative py-32 bg-slate-950 overflow-hidden text-white border-t border-slate-900">
        <!-- Background Asset with dark glowing orange overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-building3.jpg') }}" class="w-full h-full object-cover opacity-20" alt="Sador construction project background" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950 to-slate-950"></div>
        </div>
        
        <div class="container mx-auto px-4 max-w-7xl relative z-10" data-aos="zoom-in">
            <div class="max-w-5xl mx-auto bg-white/[0.03] backdrop-blur-xl border border-white/5 rounded-[40px] p-12 md:p-20 text-center shadow-2xl relative overflow-hidden">
                <!-- Tiny floating elements -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-sador-orange/20 rounded-full filter blur-3xl"></div>
                
                <h2 class="text-3xl sm:text-5xl md:text-6xl font-display font-extrabold text-white mb-6 leading-tight max-w-4xl mx-auto">
                    Ready to build your next engineering footprint?
                </h2>
                
                <p class="text-base md:text-lg text-slate-400 mb-12 max-w-3xl mx-auto leading-relaxed font-light font-sans">
                    Collaborate with Sador's premier civil contracting team to bring your architectural blueprints, real estate compounds, or regional infrastructure works to life.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-5">
                    <a href="/contact" class="bg-gradient-to-r from-sador-orange to-amber-500 text-white px-10 py-5 rounded-2xl font-bold text-sm uppercase tracking-widest hover:opacity-95 shadow-xl shadow-sador-orange/20 transition-all">
                        Contact Us
                    </a>
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $settings['whatsapp_number'] ?? '+251911708175') }}" class="bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:border-slate-700 px-10 py-5 rounded-2xl font-bold text-sm uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                        <i data-lucide="phone-call" class="w-4 h-4 text-sador-orange"></i>
                        Direct Call: {{ $settings['company_phone'] ?? '+251 911 70 81 75' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection