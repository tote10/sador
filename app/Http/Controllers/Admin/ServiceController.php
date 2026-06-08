<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('services/images', 'public');
        }

        Service::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'image_path' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);

        $imagePath = $service->image_path;
        if ($request->hasFile('image_path')) {
            if ($imagePath && !str_starts_with($imagePath, 'http')) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image_path')->store('services/images', 'public');
        }

        $service->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'image_path' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path && !str_starts_with($service->image_path, 'http')) {
            Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
