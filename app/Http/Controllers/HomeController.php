<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Award;
use App\Models\Partner;

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

        $testimonials = Testimonial::published()->take(12)->get();
        $awards = Award::published()->take(12)->get();
        $partners = Partner::published()->orderBy('sort_order')->latest()->take(24)->get();

        return view('welcome', compact('featuredProjects', 'services', 'testimonials', 'awards', 'partners'));
    }
}