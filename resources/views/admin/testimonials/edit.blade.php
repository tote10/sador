@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.testimonials.index')" label="Back to Testimonials" />

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Client Name -->
            <div>
                <label for="client_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('client_name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Position / Company -->
            <div>
                <label for="position" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Position & Company</label>
                <input type="text" name="position" id="position" value="{{ old('position', $testimonial->position) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('position') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Star Rating -->
            <div>
                <label for="rating" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Star Rating</label>
                <select name="rating" id="rating" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                    <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>1 Star</option>
                </select>
                @error('rating') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="py-2">
                <x-admin.checkbox name="is_published" label="Publish on Website" :checked="(bool) old('is_published', $testimonial->is_published)" />
            </div>
        </div>

        <!-- Quote -->
        <div>
            <label for="quote" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Quote</label>
            <textarea name="quote" id="quote" rows="4" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('quote', $testimonial->quote) }}</textarea>
            @error('quote') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <!-- Photo management -->
        <div class="border-t border-slate-800 pt-6 flex items-center gap-6">
            @if ($testimonial->photo_url)
                <div class="w-16 h-16 rounded-full overflow-hidden border border-slate-800 bg-slate-950/40 shrink-0">
                    <img src="{{ $testimonial->photo_url }}" class="w-full h-full object-cover" alt="Client avatar">
                </div>
            @endif
            <div class="flex-1">
                <label for="photo_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Replace Photo</label>
                <input type="file" name="photo_path" id="photo_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Update Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
