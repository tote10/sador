<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Award;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::with('coverImage')
            ->published()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $services = Service::published()
            ->featured()
            ->take(6)
            ->get();

        $testimonials = Testimonial::published()->get();
        $awards = Award::published()->get();

        return view('welcome', compact('featuredProjects', 'services', 'testimonials', 'awards'));
    }
}