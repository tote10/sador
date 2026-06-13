@extends('layouts.admin')

@section('title', 'Add New Service')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.services.index')" label="Back to Services" />

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Service Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="block w-full px-4 py-3 bg-white/60 border border-slate-800 rounded-xl text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('title') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Short Description -->
            <div>
                <label for="short_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Short Description</label>
                <input type="text" name="short_description" id="short_description" value="{{ old('short_description') }}" required placeholder="e.g. Brief summary shown on lists." class="block w-full px-4 py-3 bg-white/60 border border-slate-800 rounded-xl text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('short_description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Full Description -->
            <div>
                <label for="full_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Full Description</label>
                <textarea name="full_description" id="full_description" rows="6" required placeholder="Detailed information about the service scope, tools, methodologies, etc." class="block w-full px-4 py-3 bg-white/60 border border-slate-800 rounded-xl text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('full_description') }}</textarea>
                @error('full_description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Image -->
                <div>
                    <label for="image_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Service Image</label>
                    <input type="file" name="image_path" id="image_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
                    @error('image_path') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="admin-checkbox">
                        <span class="checkbox-mark"></span>
                        <span class="text-[10px] text-slate-500 ml-7">Publish on Website</span>
                    </label>
                </div>
                <div class="space-y-1">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="admin-checkbox">
                        <span class="checkbox-mark"></span>
                        <span class="text-[10px] text-slate-500 ml-7">Feature on Home</span>
                    </label>
                </div>
            </div>

            <script>
                    const publishedCheckbox = document.getElementById(\'is_published\');

                    if (featuredCheckbox && publishedCheckbox) {
                        featuredCheckbox.addEventListener(\'change\', function() {
                            if (this.checked) {
                                publishedCheckbox.checked = true;
                            }
                        });

                        publishedCheckbox.addEventListener(\'change\', function() {
                            if (!this.checked) {
                                featuredCheckbox.checked = false;
                            }
                        });
                    }
                });
            </script>
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Save Service
            </button>
        </div>
    </form>
</div>
@endsection
