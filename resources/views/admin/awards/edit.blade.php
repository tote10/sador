@extends('layouts.admin')

@section('title', 'Edit Award')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.awards.index')" label="Back to Awards" />

    <form action="{{ route('admin.awards.update', $award->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Award Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $award->title) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('title') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Year -->
            <div>
                <label for="year" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Year Awarded</label>
                <input type="text" name="year" id="year" value="{{ old('year', $award->year) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('year') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Organization -->
            <div>
                <label for="organization" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Awarding Organization</label>
                <input type="text" name="organization" id="organization" value="{{ old('organization', $award->organization) }}" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('organization') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="py-2">
                <x-admin.checkbox name="is_published" label="Publish on Website" :checked="(bool) old('is_published', $award->is_published)" />
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Description</label>
            <textarea name="description" id="description" rows="3" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('description', $award->description) }}</textarea>
            @error('description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <!-- Logo management -->
        <div class="border-t border-slate-800 pt-6 flex items-center gap-6">
            @if ($award->logo_url)
                <div class="w-16 h-16 rounded-2xl overflow-hidden border border-slate-800 bg-white p-2 shrink-0">
                    <img src="{{ $award->logo_url }}" class="w-full h-full object-contain" alt="Award logo current">
                </div>
            @endif
            <div class="flex-1">
                <label for="logo_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Replace Logo</label>
                <input type="file" name="logo_path" id="logo_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Update Award
            </button>
        </div>
    </form>
</div>
@endsection
