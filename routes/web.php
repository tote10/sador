<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/projects', function () {
    return view('projects');
});

Route::get('/projects/{slug}', function ($slug) {
    $project = \App\Helpers\ProjectHelper::find($slug);
    if (!$project) {
        abort(404);
    }
    return view('project-details', compact('project'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/vacancies', function () {
    return view('vacancies');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ... (keep the rest of your profile and auth routes here) ...
require __DIR__.'/auth.php';