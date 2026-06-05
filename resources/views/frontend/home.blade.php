@extends('layouts.main')

@section('title', 'Home')

@section('content')
<!-- Added bg-slate-900 as a fallback background color so text is visible immediately -->
<div class="min-h-screen bg-slate-900">
    
    <!-- Hero Section: Added py-20 and bg-slate-800 as fallback styling -->
    <section class="hero-bg min-h-screen bg-slate-800 flex items-center justify-center relative py-20" 
         style="background-image: url('{{ asset('images/hero-building.jpg') }}'); background-size: cover; background-position: center;">

        
        <div class="max-w-7xl mx-auto px-6 text-white text-center z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-4" data-aos="fade-up">
                Sador General Construction
            </h1>
            <p class="text-2xl mb-8" data-aos="fade-up" data-aos-delay="200">
                Building Ethiopia's Future with Excellence
            </p>
            <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
                <a href="#" class="bg-orange-600 px-8 py-4 rounded-lg font-semibold hover:bg-orange-700 transition">
                    View Projects
                </a>
                <a href="/contact" class="border-2 border-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-black transition">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
