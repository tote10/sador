<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('testimonials', 'public');
        }

        Testimonial::create([
            'client_name' => $request->client_name,
            'position' => $request->position,
            'quote' => $request->quote,
            'rating' => $request->rating,
            'photo_path' => $photoPath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $photoPath = $testimonial->photo_path;
        if ($request->hasFile('photo_path')) {
            if ($photoPath && !str_starts_with($photoPath, 'http')) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo_path')->store('testimonials', 'public');
        }

        $testimonial->update([
            'client_name' => $request->client_name,
            'position' => $request->position,
            'quote' => $request->quote,
            'rating' => $request->rating,
            'photo_path' => $photoPath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo_path && !str_starts_with($testimonial->photo_path, 'http')) {
            Storage::disk('public')->delete($testimonial->photo_path);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
