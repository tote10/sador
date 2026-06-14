@extends('layouts.main')

@section('title', 'Careers at Sador')
@section('meta_description', 'Join Sador General Construction. Explore open engineering, site and management roles, or submit a speculative application to build your career with us.')

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
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 text-xs font-semibold" data-aos="fade-up">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-8" x-data="{ activeJob: null, activeJobTitle: '' }">
                @forelse($vacancies as $job)
                    <!-- Vacancy Card -->
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-lg hover:shadow-xl hover:border-sador-blue/20 transition-all duration-300 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 group" data-aos="fade-up">
                        <div class="space-y-4 flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <h2 class="text-2xl font-display font-extrabold text-slate-900 group-hover:text-sador-blue transition-colors">
                                    {{ $job->title }}
                                </h2>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    {{ $job->type }}
                                </span>
                            </div>
                            
                            <!-- Metadata Tags -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs text-slate-500 font-semibold border-y border-slate-50 py-3.5">
                                <span class="flex items-center gap-2">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                                    {{ $job->location }}
                                </span>
                                <span class="flex items-center gap-2">
                                    <i data-lucide="briefcase" class="w-4 h-4 text-slate-400"></i>
                                    {{ $job->experience }}
                                </span>
                                <span class="flex items-center gap-2">
                                    <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-400"></i>
                                    {{ $job->education ?? 'Degree' }}
                                </span>
                                <span class="flex items-center gap-2">
                                    <i data-lucide="dollar-sign" class="w-4 h-4 text-slate-400"></i>
                                    {{ $job->salary ?? 'Negotiable' }}
                                </span>
                            </div>
                            
                            <p class="text-slate-500 text-sm leading-relaxed max-w-3xl">
                                {{ $job->description }}
                            </p>
                        </div>
                        
                        <div class="w-full md:w-auto shrink-0">
                            <button @click="activeJob = {{ $job->id }}; activeJobTitle = '{{ $job->title }}'" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-sador-blue to-slate-900 hover:from-sador-orange hover:to-amber-500 text-white w-full md:w-auto px-8 py-4.5 rounded-2xl font-bold text-xs uppercase tracking-wider transition-all duration-300 hover:-translate-y-0.5 shadow-lg group">
                                Apply for Role
                                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-12 text-center text-slate-500 border border-slate-100 shadow-md">
                        There are currently no active job vacancies. Please check back later.
                    </div>
                @endforelse

                @if($vacancies->hasPages())
                    <div class="pt-4">
                        {{ $vacancies->links() }}
                    </div>
                @endif

                <!-- Application Slide-out Modal Overlay -->
                <div x-show="activeJob !== null" 
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
                     style="display: none;"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    
                    <div class="relative bg-white rounded-3xl max-w-lg w-full p-8 text-slate-800 shadow-2xl border border-slate-100 flex flex-col max-h-[90vh] overflow-y-auto"
                         @click.away="activeJob = null">
                        
                        <div class="flex justify-between items-start border-b border-slate-100 pb-4 mb-6">
                            <div>
                                <h3 class="text-xl font-display font-extrabold text-slate-900">Job Application</h3>
                                <p class="text-xs text-slate-400 font-light mt-1">Applying for: <span class="text-sador-orange font-bold" x-text="activeJobTitle"></span></p>
                            </div>
                            <button @click="activeJob = null" class="text-slate-400 hover:text-slate-700 p-1 rounded-lg hover:bg-slate-50 transition">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <form :action="activeJob === 0 ? '{{ route('careers.apply') }}' : '/vacancies/' + activeJob + '/apply'" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text" name="full_name" required class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" placeholder="Abebe Kebede">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Number</label>
                                    <input type="text" name="phone" required class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" placeholder="+251 9...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                                    <input type="email" name="email" required class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" placeholder="abebe@example.com">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Cover Letter / Statement</label>
                                <textarea name="message" rows="3" class="w-full border-slate-200 focus:border-sador-orange focus:ring-sador-orange/20 rounded-xl py-3 px-4 text-sm transition-all focus:outline-none" placeholder="Explain why you are the best fit for this engineering post..."></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Attach CV (PDF, DOC, DOCX - max 10MB)</label>
                                <input type="file" name="cv" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/10 file:text-sador-blue hover:file:bg-sador-blue/20 cursor-pointer">
                            </div>

                            <div class="border-t border-slate-100 pt-6 flex justify-end gap-3">
                                <button type="button" @click="activeJob = null" class="px-5 py-3 border border-slate-250 hover:bg-slate-50 text-slate-500 rounded-xl font-bold uppercase tracking-wider text-xs transition">Cancel</button>
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-white font-display font-extrabold uppercase tracking-widest text-xs rounded-xl shadow-lg shadow-sador-orange/20 transition-all flex items-center gap-2">
                                    Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- General Application Widget -->
            <div class="mt-20 bg-slate-900 rounded-[32px] p-8 md:p-12 text-white relative overflow-hidden border border-slate-800" data-aos="zoom-in">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-sador-orange/20 rounded-full filter blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-display font-extrabold mb-3">Don't see your domain listed?</h3>
                        <p class="text-slate-400 text-sm max-w-2xl leading-relaxed">We are constantly recruiting high-potential civil, structural, safety compliance, and estimating experts. Submit your CV as a general speculative candidate.</p>
                    </div>
                    <button @click="activeJob = 0; activeJobTitle = 'General Speculative Candidate'" class="bg-gradient-to-r from-sador-orange to-amber-500 text-white px-8 py-4.5 rounded-2xl font-bold uppercase tracking-wider text-xs shadow-lg shadow-sador-orange/20 transition-all shrink-0">
                        Submit Open CV
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection