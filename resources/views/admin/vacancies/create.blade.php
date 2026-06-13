@extends('layouts.admin')

@section('title', 'Post New Career Position')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.vacancies.index')" label="Back to Vacancies" />

    <form action="{{ route('admin.vacancies.store') }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Job Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="e.g. Senior Civil Engineer" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('title') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Job Type</label>
                <input type="text" name="type" id="type" value="{{ old('type', 'Full-Time') }}" required placeholder="e.g. Full-Time, Contract, Part-Time" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('type') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', 'Addis Ababa') }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('location') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Experience -->
            <div>
                <label for="experience" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Experience Required</label>
                <input type="text" name="experience" id="experience" value="{{ old('experience') }}" required placeholder="e.g. 5+ Years" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('experience') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Education -->
            <div>
                <label for="education" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Education / Degree</label>
                <input type="text" name="education" id="education" value="{{ old('education') }}" placeholder="e.g. B.Sc. in Civil Engineering" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('education') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Salary -->
            <div>
                <label for="salary" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Salary Range</label>
                <input type="text" name="salary" id="salary" value="{{ old('salary', 'Attractive & Negotiable') }}" placeholder="e.g. Negotiable" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('salary') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Deadline -->
            <div>
                <label for="deadline" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Application Deadline</label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('deadline') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2 py-2">
                <x-admin.checkbox name="is_open" label="Open for Applications" :checked="old('is_open', '1') ? true : false" />
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Job Description & Requirements</label>
            <textarea name="description" id="description" rows="8" required placeholder="Outline job responsibilities, required skills, Certifications, working conditions..." class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('description') }}</textarea>
            @error('description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Post Vacancy
            </button>
        </div>
    </form>
</div>
@endsection
