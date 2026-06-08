<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::latest()->paginate(10);
        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        return view('admin.vacancies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'description' => 'required|string',
            'is_open' => 'nullable|boolean',
        ]);

        Vacancy::create([
            'title' => $request->title,
            'type' => $request->type,
            'location' => $request->location,
            'experience' => $request->experience,
            'education' => $request->education,
            'salary' => $request->salary,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'is_open' => $request->boolean('is_open', true),
        ]);

        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy posted successfully.');
    }

    public function edit(Vacancy $vacancy)
    {
        return view('admin.vacancies.edit', compact('vacancy'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'description' => 'required|string',
            'is_open' => 'nullable|boolean',
        ]);

        $vacancy->update([
            'title' => $request->title,
            'type' => $request->type,
            'location' => $request->location,
            'experience' => $request->experience,
            'education' => $request->education,
            'salary' => $request->salary,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'is_open' => $request->boolean('is_open'),
        ]);

        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy updated successfully.');
    }

    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('admin.vacancies.index')->with('success', 'Vacancy deleted successfully.');
    }
}
