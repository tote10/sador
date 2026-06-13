@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.services.index')" label="Back to Services" />

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Service Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('title') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Short Description -->
            <div>
                <label for="short_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Short Description</label>
                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $service->short_description) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('short_description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Full Description -->
            <div>
                <label for="full_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Full Description</label>
                <textarea name="full_description" id="full_description" rows="6" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('full_description', $service->full_description) }}</textarea>
                @error('full_description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Image Management -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t border-slate-800 pt-6">
                <div class="flex items-center gap-4">
                    @if ($service->image_url)
                        <div class="w-24 h-16 rounded-xl overflow-hidden border border-slate-850 shrink-0 bg-slate-950/60">
                            <img src="{{ $service->image_url }}" class="w-full h-full object-cover" alt="Service current image">
                        </div>
                    @endif
                    <div class="flex-1">
                        <label for="image_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Replace Image</label>
                        <input type="file" name="image_path" id="image_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 md:justify-end py-3">
                    <x-admin.checkbox name="is_featured" label="Feature on Home" :checked="(bool) old('is_featured', $service->is_featured)" />
                    <x-admin.checkbox name="is_published" label="Publish on Website" :checked="(bool) old('is_published', $service->is_published)" />
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Update Service
            </button>
        </div>
    </form>
</div>
@endsection
