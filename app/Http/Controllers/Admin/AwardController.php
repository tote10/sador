<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{

    public function index()
    {
        $awards = Award::latest()->paginate(10);
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'organization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_path')) {
            $logoPath = $request->file('logo_path')->store('awards', 'public');
        }

        Award::create([
            'title' => $request->title,
            'year' => $request->year,
            'organization' => $request->organization,
            'description' => $request->description,
            'logo_path' => $logoPath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.awards.index')->with('success', 'Award added successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'organization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $logoPath = $award->logo_path;
        if ($request->hasFile('logo_path')) {
            if ($logoPath && !str_starts_with($logoPath, 'http')) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo_path')->store('awards', 'public');
        }

        $award->update([
            'title' => $request->title,
            'year' => $request->year,
            'organization' => $request->organization,
            'description' => $request->description,
            'logo_path' => $logoPath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        if ($award->logo_path && !str_starts_with($award->logo_path, 'http')) {
            Storage::disk('public')->delete($award->logo_path);
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
