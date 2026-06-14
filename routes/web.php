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
    $services = \App\Models\Service::published()->paginate(9);
    return view('services', compact('services'));
});

Route::get('/projects', function () {
    // Capped (not paginated) because the page filters client-side over the full set via Alpine.js;
    // paginating would break the category/year/location dropdowns. Revisit with server-side
    // filtering if published projects ever exceed this cap.
    $projects = \App\Models\Project::with('coverImage')->published()->latest()->take(60)->get();
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
    $vacancies = \App\Models\Vacancy::open()->latest()->paginate(10);
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
})->middleware('throttle:5,1')->name('contact.store');

Route::post('/vacancies/{vacancy}/apply', function (Illuminate\Http\Request $request, \App\Models\Vacancy $vacancy) {
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'nullable|string',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    if (!$vacancy->is_open) {
        return back()->with('error', 'This vacancy is no longer accepting applications.');
    }

    $cvPath = $request->file('cv')->store('applicants/cvs', 'local');

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
})->middleware('throttle:5,1')->name('vacancies.apply');

// General / speculative application (not tied to a specific vacancy)
Route::post('/careers/apply', function (Illuminate\Http\Request $request) {
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'nullable|string',
        'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    $cvPath = $request->file('cv')->store('applicants/cvs', 'local');

    \App\Models\Applicant::create([
        'vacancy_id' => null,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'message' => $request->message,
        'cv_path' => $cvPath,
        'status' => 'new',
    ]);

    return back()->with('success', 'Your application has been submitted successfully.');
})->middleware('throttle:5,1')->name('careers.apply');

// ======================
// SEO: sitemap & robots
// ======================
Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'),         'priority' => '1.0'],
        ['loc' => url('/about'),    'priority' => '0.8'],
        ['loc' => url('/services'), 'priority' => '0.8'],
        ['loc' => url('/projects'), 'priority' => '0.8'],
        ['loc' => url('/vacancies'),'priority' => '0.7'],
        ['loc' => url('/contact'),  'priority' => '0.7'],
    ];

    foreach (\App\Models\Project::published()->get() as $project) {
        $urls[] = ['loc' => url('/projects/' . $project->slug), 'priority' => '0.6'];
    }

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        $xml .= '  <url><loc>' . htmlspecialchars($u['loc'], ENT_XML1) . '</loc><priority>' . $u['priority'] . '</priority></url>' . "\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\n"
        . "Disallow: /admin\n"
        . "Disallow: /login\n\n"
        . 'Sitemap: ' . url('/sitemap.xml') . "\n";

    return response($content, 200, ['Content-Type' => 'text/plain']);
})->name('robots');


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