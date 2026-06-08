<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::with('coverImage')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in the database.
     * Handles file uploads for the cover photo and subsequent gallery images.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'budget' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'category' => $request->category,
            'location' => $request->location,
            'year' => $request->year,
            'budget' => $request->budget,
            'duration' => $request->duration,
            'client_name' => $request->client_name,
            'status' => $request->status,
            'description' => $request->description,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        // Store cover image - Cover image sort_order is always 0
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('projects/images', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path,
                'is_cover' => true,
                'sort_order' => 0,
            ]);
        }

        // Store gallery images with incrementing sort order starting from 1
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $file) {
                $path = $file->store('projects/images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'is_cover' => false,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     * Eager loads the associated images list.
     * 
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function edit(Project $project)
    {
        $project->load('images');
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in the database.
     * Allows replacing the cover image and appending additional gallery files.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'budget' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $project->update([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $project->id),
            'category' => $request->category,
            'location' => $request->location,
            'year' => $request->year,
            'budget' => $request->budget,
            'duration' => $request->duration,
            'client_name' => $request->client_name,
            'status' => $request->status,
            'description' => $request->description,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ]);

        // Update cover image if uploaded
        if ($request->hasFile('cover_image')) {
            // Delete old cover image from disk if it is a local upload
            $oldCover = ProjectImage::where('project_id', $project->id)->where('is_cover', true)->first();
            if ($oldCover) {
                if (!str_starts_with($oldCover->image_path, 'http')) {
                    Storage::disk('public')->delete($oldCover->image_path);
                }
                $oldCover->delete();
            }

            $path = $request->file('cover_image')->store('projects/images', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path,
                'is_cover' => true,
                'sort_order' => 0,
            ]);
        }

        // Add more gallery images if uploaded
        if ($request->hasFile('gallery_images')) {
            $lastSort = ProjectImage::where('project_id', $project->id)->max('sort_order') ?? 0;
            foreach ($request->file('gallery_images') as $index => $file) {
                $path = $file->store('projects/images', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'is_cover' => false,
                    'sort_order' => $lastSort + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project and its associated images from the database.
     * Cleans up local disk assets to prevent orphaned storage.
     * 
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        // Delete all associated files from storage first
        foreach ($project->images as $img) {
            // Only delete local paths, not external mock/Unsplash URLs
            if (!str_starts_with($img->image_path, 'http')) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    /**
     * Delete a specific gallery image.
     * Prevents deletion of the primary cover image.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyImage($id)
    {
        $image = ProjectImage::findOrFail($id);
        
        if ($image->is_cover) {
            return back()->with('error', 'Cannot delete cover image. Upload a new cover image instead.');
        }

        // Clean up from public storage disk if local file path
        if (!str_starts_with($image->image_path, 'http')) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();

        return back()->with('success', 'Gallery image deleted.');
    }

    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);

        // Build the query to check if this slug already exists
        $query = Project::where('slug', $slug);
        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }

        // If it exists, append a 4-character random string to make it unique instantly
        if ($query->exists()) {
            $slug = $slug . '-' . Str::lower(Str::random(4));
        }

        return $slug;
    }
}
