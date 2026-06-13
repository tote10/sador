@extends('layouts.admin')

@section('title', 'Add New Testimonial')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.testimonials.index')" label="Back to Testimonials" />

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Client Name -->
            <div>
                <label for="client_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required placeholder="e.g. Martha Girma" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('client_name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Position / Company -->
            <div>
                <label for="position" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Position & Company</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" required placeholder="e.g. Managing Partner, Zola Luxury Apartments" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('position') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Star Rating -->
            <div>
                <label for="rating" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Star Rating</label>
                <select name="rating" id="rating" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                </select>
                @error('rating') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="py-2">
                <x-admin.checkbox name="is_published" label="Publish on Website" :checked="old('is_published', '1') ? true : false" />
            </div>
        </div>

        <!-- Quote -->
        <div>
            <label for="quote" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Quote</label>
            <textarea name="quote" id="quote" rows="4" required placeholder="What did the client say about working with Sador Construction?" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('quote') }}</textarea>
            @error('quote') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <!-- Photo upload -->
        <div class="border-t border-slate-800 pt-6">
            <label for="photo_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Photo / Avatar</label>
            <input type="file" name="photo_path" id="photo_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
            @error('photo_path') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Save Testimonial
            </button>
        </div>
    </form>
</div>
@endsection
