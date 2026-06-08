<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\Message;
use App\Models\Applicant;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'applicants' => Applicant::count(),
            'new_applicants' => Applicant::where('status', 'new')->count(),
        ];

        $recentMessages = Message::latest()->take(5)->get();
        $recentApplicants = Applicant::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentApplicants'));
    }
}
