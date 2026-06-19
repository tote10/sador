@extends('layouts.admin')

@section('title', 'Add New Partner')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.partners.index')" label="Back to Partners" />

    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Partner Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. NOAH DEVELOPERS" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Role label -->
            <div>
                <label for="role_label" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Role / Label</label>
                <input type="text" name="role_label" id="role_label" value="{{ old('role_label') }}" placeholder="e.g. Real Estate Partner" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('role_label') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Sort order -->
            <div>
                <label for="sort_order" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Display Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" placeholder="0" class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('sort_order') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2 py-2">
                <x-admin.checkbox name="is_published" label="Publish on Website" :checked="old('is_published', '1') ? true : false" />
            </div>
        </div>

        <!-- Logo upload -->
        <div class="border-t border-slate-800 pt-6">
            <label for="logo_path" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Partner Logo Image</label>
            <input type="file" name="logo_path" id="logo_path" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
            <p class="text-[10px] text-slate-500 mt-2">PNG, JPG, WEBP or SVG. Transparent logos look best.</p>
            @error('logo_path') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Save Partner
            </button>
        </div>
    </form>
</div>
@endsection
