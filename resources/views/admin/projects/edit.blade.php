@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.form-back :route="route('admin.projects.index')" label="Back to Projects" />

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Project Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('title') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Category</label>
                <select name="category" id="category" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                    <option value="commercial" {{ old('category', $project->category) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="residential" {{ old('category', $project->category) == 'residential' ? 'selected' : '' }}>Residential</option>
                    <option value="infrastructure" {{ old('category', $project->category) == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                </select>
                @error('category') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $project->location) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('location') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Year -->
            <div>
                <label for="year" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Year Completed</label>
                <input type="text" name="year" id="year" value="{{ old('year', $project->year) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('year') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Budget -->
            <div>
                <label for="budget" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Project Budget</label>
                <input type="text" name="budget" id="budget" value="{{ old('budget', $project->budget) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('budget') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Duration -->
            <div>
                <label for="duration" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $project->duration) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('duration') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Client Name -->
            <div>
                <label for="client_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Client Name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $project->client_name) }}" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                @error('client_name') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Project Status</label>
                <select name="status" id="status" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">
                    <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Ongoing" {{ old('status', $project->status) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                </select>
                @error('status') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2 flex flex-wrap items-center gap-6 py-2">
                <x-admin.checkbox name="is_featured" label="Feature on Home Page" :checked="(bool) old('is_featured', $project->is_featured)" />
                <x-admin.checkbox name="is_published" label="Publish on Website" :checked="(bool) old('is_published', $project->is_published)" />
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Description</label>
            <textarea name="description" id="description" rows="6" required class="block w-full px-4 py-3 bg-slate-950/60 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sador-orange/50 focus:border-sador-orange text-xs transition duration-200">{{ old('description', $project->description) }}</textarea>
            @error('description') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <!-- Images -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-800 pt-6">
            <div>
                <label for="cover_image" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Upload New Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sador-blue/20 file:text-sador-blue hover:file:bg-sador-blue/30 file:cursor-pointer cursor-pointer">
                <p class="text-[10px] text-slate-500 mt-1.5 font-light">Leave blank to keep current cover image.</p>
                @error('cover_image') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="border-t border-slate-800 pt-6">
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">Upload Additional Gallery Images (Multiple)</label>
            
            <div x-data="{
                files: [],
                addFiles(event) {
                    const newFiles = Array.from(event.target.files);
                    newFiles.forEach(file => {
                        const url = URL.createObjectURL(file);
                        this.files.push({
                            file: file,
                            url: url,
                            name: file.name
                        });
                    });
                    this.syncFiles();
                    event.target.value = '';
                },
                removeFile(index) {
                    if (this.files[index].url) {
                        URL.revokeObjectURL(this.files[index].url);
                    }
                    this.files.splice(index, 1);
                    this.syncFiles();
                },
                syncFiles() {
                    const dataTransfer = new DataTransfer();
                    this.files.forEach(item => {
                        dataTransfer.items.add(item.file);
                    });
                    document.getElementById('gallery_images_hidden').files = dataTransfer.files;
                }
            }" class="space-y-4">
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <!-- Preview newly added files -->
                    <template x-for="(item, index) in files" :key="index">
                        <div class="relative group bg-slate-950/40 border border-slate-800 rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center">
                            <img :src="item.url" class="w-full h-full object-cover" />
                            
                            <button type="button" @click="removeFile(index)" class="absolute top-2 right-2 w-7 h-7 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 shadow-md flex items-center justify-center">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                            
                            <div class="absolute bottom-0 inset-x-0 bg-slate-950/80 px-2 py-1 truncate text-[9px] text-slate-400 font-mono" x-text="item.name"></div>
                        </div>
                    </template>
                    
                    <!-- Add file button box -->
                    <label class="relative border-2 border-dashed border-slate-800 hover:border-sador-orange/50 rounded-2xl flex flex-col items-center justify-center aspect-[4/3] cursor-pointer transition duration-200 bg-slate-950/20 group">
                        <i data-lucide="plus-circle" class="w-8 h-8 text-slate-500 group-hover:text-sador-orange transition-colors mb-2"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 group-hover:text-slate-400">Add Image</span>
                        <input type="file" @change="addFiles($event)" accept="image/*" class="hidden" multiple>
                    </label>
                </div>
                
                <!-- Hidden input that holds the synchronized files for submission -->
                <input type="file" name="gallery_images[]" id="gallery_images_hidden" class="hidden" multiple>
                @error('gallery_images.*') <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>

        @if ($project->images->isNotEmpty())
        <div class="border-t border-slate-800 pt-6 space-y-3">
            <h5 class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Current Gallery Images</h5>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach ($project->images as $img)
                    <div class="relative group bg-slate-950/40 border border-slate-800 rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center">
                        <img src="{{ $img->url }}" class="w-full h-full object-cover" alt="Project image">

                        @if ($img->is_cover)
                            <span class="absolute top-2 left-2 px-2 py-0.5 rounded bg-sador-orange text-white text-[8px] font-extrabold uppercase tracking-widest shadow-md">Cover</span>
                        @else
                            <button type="button"
                                    onclick="if(confirm('Delete this gallery image?')) { document.getElementById('delete-img-{{ $img->id }}').submit(); }"
                                    class="absolute top-2 right-2 p-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg opacity-0 group-hover:opacity-100 transition duration-200 shadow-md">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5">
                Update Project
            </button>
        </div>
    </form>

    <!-- Hidden image deletion forms -->
    @foreach ($project->images as $img)
        @if (!$img->is_cover)
            <form id="delete-img-{{ $img->id }}" action="{{ route('admin.projects.images.destroy', $img->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endforeach
</div>
@endsection
