@extends('layouts.main')

@section('title', 'Page Not Found')

@section('content')
    <section class="min-h-[70vh] flex items-center bg-slate-50 py-32">
        <div class="container mx-auto px-4 max-w-3xl text-center" data-aos="fade-up">
            <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-4 block">Error 404</span>
            <h1 class="text-5xl sm:text-7xl font-display font-extrabold text-slate-900 mb-4">Page Not Found</h1>
            <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                The page you are looking for may have been moved, removed, or never existed.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-sador-orange to-amber-500 text-white px-8 py-4 rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg shadow-sador-orange/20 hover:opacity-95 transition-all">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    Back to Home
                </a>
                <a href="/projects" class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-700 px-8 py-4 rounded-2xl font-bold text-sm uppercase tracking-widest hover:border-sador-blue hover:text-sador-blue transition-all">
                    View Projects
                </a>
            </div>
        </div>
    </section>
@endsection
