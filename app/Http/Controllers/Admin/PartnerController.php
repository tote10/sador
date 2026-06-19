<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role_label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_path')) {
            $logoPath = $request->file('logo_path')->store('partners', 'public');
        }

        Partner::create([
            'name' => $request->name,
            'role_label' => $request->role_label,
            'sort_order' => $request->integer('sort_order'),
            'logo_path' => $logoPath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role_label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $logoPath = $partner->logo_path;
        if ($request->hasFile('logo_path')) {
            if ($logoPath && !str_starts_with($logoPath, 'http')) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo_path')->store('partners', 'public');
        }

        $partner->update([
            'name' => $request->name,
            'role_label' => $request->role_label,
            'sort_order' => $request->integer('sort_order'),
            'logo_path' => $logoPath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo_path && !str_starts_with($partner->logo_path, 'http')) {
            Storage::disk('public')->delete($partner->logo_path);
        }
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
