@extends('layouts.main')

@section('title', $project->title)
@section('meta_description', Str::limit(strip_tags($project->description), 150))
@section('og_image', $project->cover_url)

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Projects", "item": "{{ url('/projects') }}" },
        { "@type": "ListItem", "position": 3, "name": {!! json_encode($project->title) !!}, "item": "{{ url()->current() }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CreativeWork",
    "name": {!! json_encode($project->title) !!},
    "description": {!! json_encode(Str::limit(strip_tags($project->description), 300)) !!},
    "image": "{{ $project->cover_url }}",
    @if($project->year)"dateCreated": "{{ $project->year }}",@endif
    @if($project->location)"locationCreated": { "@type": "Place", "name": {!! json_encode($project->location) !!} },@endif
    "url": "{{ url()->current() }}",
    "provider": {
        "@type": "GeneralContractor",
        "name": "Sador General Construction",
        "url": "{{ url('/') }}"
    }
}
</script>
@endpush

@section('content')
@php
    $src = $project->cover_url;
    $cat_label = ucfirst($project->category);
    $year = $project->year;
    $loc = $project->location;
    $budget = $project->budget;
    $duration = $project->duration;
    $client = $project->client_name;
    $status = $project->status;
    $desc = $project->description;

    $loc_label = str_contains(strtolower($loc), 'addis ababa') ? 'Addis Ababa' : (str_contains(strtolower($loc), 'hawassa') ? 'Hawassa' : (str_contains(strtolower($loc), 'adama') ? 'Adama' : $loc));
    $scale = 'Premium Build';
    $challenges = 'Overcoming tight schedule constraints and maintaining strict quality and environmental standards throughout the project execution.';
    $solutions = 'Deployed high-efficiency construction crews, advanced scheduling tools, and optimized supply-chain tracking to complete all project milestones on time.';
    $testimonial = 'Sador General Construction demonstrated professional excellence, delivery discipline, and high-quality standards.';
    $client_person = $client;
    $client_title = 'Project Representative';
    
    // Gallery images
    $images = $project->images->map(fn($img) => $img->url)->toArray();
    if (empty($images)) {
        $images = [$src];
    }
@endphp

    <!-- Hero -->
    <section class="relative min-h-[70vh] flex items-end pt-28 pb-16 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $src }}" alt="{{ $project->title }}" class="w-full h-full object-cover" fetchpriority="high">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-950/40"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/50 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 max-w-7xl relative z-10" data-aos="fade-up">
            <a href="/projects" class="inline-flex items-center gap-2.5 bg-white/15 hover:bg-white/25 border border-white/30 text-white text-xs font-bold uppercase tracking-widest mb-8 px-4 py-2.5 rounded-xl backdrop-blur-sm shadow-lg transition-all duration-300 group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                Back to Portfolio
            </a>

            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="bg-gradient-to-r from-sador-orange to-amber-500 text-white text-[10px] font-extrabold uppercase tracking-widest px-3.5 py-1.5 rounded-lg">
                    {{ $cat_label }}
                </span>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-widest flex items-center gap-1.5">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-sador-orange"></i>
                    {{ $year }}
                </span>
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-display font-extrabold tracking-tight mb-4 max-w-4xl leading-tight">
                {{ $project->title }}
            </h1>
            <p class="text-slate-300 text-sm flex items-center gap-2 font-light">
                <i data-lucide="map-pin" class="w-4 h-4 text-sador-orange shrink-0"></i>
                {{ $loc }}
            </p>
        </div>
    </section>

    <!-- Specs Grid -->
    <section class="relative z-20 -mt-8 pb-4">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 bg-white rounded-3xl shadow-2xl shadow-slate-200/60 border border-slate-100 p-6 md:p-8" data-aos="fade-up">
                <div class="text-center md:text-left p-4 border-b md:border-b-0 md:border-r border-slate-100 last:border-0">
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Budget</div>
                    <div class="text-sm md:text-base font-bold text-slate-900">{{ $budget }}</div>
                </div>
                <div class="text-center md:text-left p-4 border-b md:border-b-0 md:border-r border-slate-100 last:border-0">
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Duration</div>
                    <div class="text-sm md:text-base font-bold text-slate-900">{{ $duration }}</div>
                </div>
                <div class="text-center md:text-left p-4 border-b md:border-b-0 md:border-r border-slate-100 last:border-0">
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Client</div>
                    <div class="text-sm md:text-base font-bold text-slate-900">{{ $client }}</div>
                </div>
                <div class="text-center md:text-left p-4 border-b md:border-b-0 md:border-r border-slate-100 last:border-0">
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Location</div>
                    <div class="text-sm md:text-base font-bold text-slate-900">{{ $loc_label }}</div>
                </div>
                <div class="text-center md:text-left p-4 col-span-2 md:col-span-1">
                    <div class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Status</div>
                    <div class="inline-flex items-center gap-2 text-sm md:text-base font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        {{ $status }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Narrative: Description + Challenges & Solutions -->
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div data-aos="fade-right">
                    <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Project Overview</span>
                    <h2 class="text-2xl sm:text-3xl font-display font-extrabold text-slate-900 mb-6">Full Description</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ Str::limit($desc, 200) }}</p>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($images))
    <!-- Image Gallery with Lightbox -->
    <section class="py-24 bg-white" x-data="{ lightboxOpen: false, activeImage: 0, images: {{ json_encode($images) }} }">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Visual Documentation</span>
                <h2 class="text-3xl sm:text-4xl font-display font-extrabold text-slate-900 mb-4">Project Gallery</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($images as $index => $image)
                <button type="button"
                        @click="activeImage = {{ $index }}; lightboxOpen = true"
                        class="group relative aspect-[4/3] rounded-3xl overflow-hidden bg-slate-200 focus:outline-none focus:ring-2 focus:ring-sador-orange focus:ring-offset-2"
                        data-aos="fade-up"
                        data-aos-delay="{{ $index * 50 }}">
                    <img src="{{ $image }}" alt="{{ $project->title }} — view {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <div class="absolute inset-0 bg-slate-950/0 group-hover:bg-slate-950/40 transition-colors flex items-center justify-center">
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity w-12 h-12 rounded-full bg-white/90 flex items-center justify-center text-slate-900">
                            <i data-lucide="maximize-2" class="w-5 h-5"></i>
                        </span>
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        <!-- Lightbox Overlay -->
        <div x-show="lightboxOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="lightboxOpen = false"
             @keydown.arrow-right.window="if (lightboxOpen) activeImage = (activeImage + 1) % images.length"
             @keydown.arrow-left.window="if (lightboxOpen) activeImage = (activeImage - 1 + images.length) % images.length"
             class="fixed inset-0 z-[100] bg-slate-950/95 flex items-center justify-center p-4"
             style="display: none;"
             x-cloak>
            <button type="button" @click="lightboxOpen = false" class="absolute top-6 right-6 w-12 h-12 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10" aria-label="Close gallery">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <button type="button" @click="activeImage = (activeImage - 1 + images.length) % images.length" class="absolute left-4 md:left-8 w-12 h-12 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10" aria-label="Previous image">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </button>

            <template x-for="(img, index) in images" :key="index">
                <img x-show="activeImage === index"
                     :src="img"
                     alt="{{ $project->title }}"
                     class="max-h-[85vh] max-w-full object-contain rounded-2xl shadow-2xl"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
            </template>

            <button type="button" @click="activeImage = (activeImage + 1) % images.length" class="absolute right-4 md:right-8 w-12 h-12 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10" aria-label="Next image">
                <i data-lucide="chevron-right" class="w-6 h-6"></i>
            </button>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/70 text-xs font-bold uppercase tracking-widest">
                <span x-text="activeImage + 1"></span> / <span x-text="images.length"></span>
            </div>
        </div>
    </section>
    @endif



    <!-- CTA -->
    <section class="bg-slate-950 py-20 relative overflow-hidden text-white border-t border-slate-900">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,#003087_0%,transparent_50%)] opacity-20"></div>
        <div class="container mx-auto px-4 max-w-7xl flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8 relative z-10">
            <div>
                <h2 class="text-3xl font-display font-extrabold mb-3">Inspired by this build?</h2>
                <p class="text-slate-400 font-light text-lg">Discuss your next commercial, residential, or civil infrastructure project with Sador.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 shrink-0">
                <a href="/projects" class="bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:border-slate-700 px-8 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs transition-all text-center">
                    More Projects
                </a>
                <a href="/contact" class="bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-white px-10 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs shadow-xl shadow-sador-orange/20 transition-all text-center">
                    Request a Quote
                </a>
            </div>
        </div>
    </section>
@endsection
