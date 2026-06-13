<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\SettingController;

// ======================
// PUBLIC ROUTES
// ======================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', function () {
    $services = \App\Models\Service::published()->get();
    return view('services', compact('services'));
});

Route::get('/projects', function () {
    $projects = \App\Models\Project::with('coverImage')->published()->latest()->get();
    return view('projects', compact('projects'));
});

Route::get('/projects/{slug}', function ($slug) {
    $project = \App\Models\Project::with('images')->where('slug', $slug)->published()->first();
    if (!$project) {
        abort(404);
    }
    return view('project-details', compact('project'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/vacancies', function () {
    $vacancies = \App\Models\Vacancy::open()->latest()->get();
    return view('vacancies', compact('vacancies'));
});

Route::get('/contact', function () {
    return view('contact');
});

// Forms Submissions
Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'service_requested' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    \App\Models\Message::create($validated);

    return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
})->name('contact.store');

Route::post('/vacancies/{vacancy}/apply', function (Illuminate\Http\Request $request, \App\Models\Vacancy $vacancy) {
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'nullable|string',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    $cvPath = $request->file('cv')->store('applicants/cvs', 'public');

    \App\Models\Applicant::create([
        'vacancy_id' => $vacancy->id,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'message' => $request->message,
        'cv_path' => $cvPath,
        'status' => 'new',
    ]);

    return back()->with('success', 'Your application has been submitted successfully.');
})->name('vacancies.apply');


// ======================
// ADMIN ROUTES (Protected)
// ======================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Projects CRUD
    Route::delete('projects/images/{id}', [ProjectController::class, 'destroyImage'])->name('admin.projects.images.destroy');
    Route::resource('projects', ProjectController::class)->names([
        'index' => 'admin.projects.index',
        'create' => 'admin.projects.create',
        'store' => 'admin.projects.store',
        'edit' => 'admin.projects.edit',
        'update' => 'admin.projects.update',
        'destroy' => 'admin.projects.destroy',
    ]);

    // Services CRUD
    Route::resource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    // Vacancies CRUD
    Route::resource('vacancies', VacancyController::class)->names([
        'index' => 'admin.vacancies.index',
        'create' => 'admin.vacancies.create',
        'store' => 'admin.vacancies.store',
        'edit' => 'admin.vacancies.edit',
        'update' => 'admin.vacancies.update',
        'destroy' => 'admin.vacancies.destroy',
    ]);

    // Testimonials CRUD
    Route::resource('testimonials', TestimonialController::class)->names([
        'index' => 'admin.testimonials.index',
        'create' => 'admin.testimonials.create',
        'store' => 'admin.testimonials.store',
        'edit' => 'admin.testimonials.edit',
        'update' => 'admin.testimonials.update',
        'destroy' => 'admin.testimonials.destroy',
    ]);

    // Awards CRUD
    Route::resource('awards', AwardController::class)->names([
        'index' => 'admin.awards.index',
        'create' => 'admin.awards.create',
        'store' => 'admin.awards.store',
        'edit' => 'admin.awards.edit',
        'update' => 'admin.awards.update',
        'destroy' => 'admin.awards.destroy',
    ]);

    // Messages Inbox
    Route::get('messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('messages/{message}/read', [MessageController::class, 'markAsRead'])->name('admin.messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Applicants Tracker
    Route::get('applicants', [ApplicantController::class, 'index'])->name('admin.applicants.index');
    Route::post('applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('admin.applicants.status');
    Route::get('applicants/{applicant}/download', [ApplicantController::class, 'downloadCv'])->name('admin.applicants.download');
    Route::delete('applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('admin.applicants.destroy');

    // Settings
    Route::get('settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');
});

// Legacy Breeze dashboard URL → admin panel
Route::redirect('/dashboard', '/admin')->middleware(['auth', 'admin'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';