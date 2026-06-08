<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with('vacancy')->latest()->paginate(15);
        return view('admin.applicants.index', compact('applicants'));
    }

    public function updateStatus(Request $request, Applicant $applicant)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,interviewed,hired,rejected',
        ]);

        $applicant->update(['status' => $request->status]);

        return back()->with('success', 'Applicant status updated successfully.');
    }

    public function downloadCv(Applicant $applicant)
    {
        if (!$applicant->cv_path || !Storage::disk('public')->exists($applicant->cv_path)) {
            return back()->with('error', 'CV file not found on server.');
        }

        return Storage::disk('public')->download($applicant->cv_path, $applicant->full_name . ' - CV.' . pathinfo($applicant->cv_path, PATHINFO_EXTENSION));
    }

    public function destroy(Applicant $applicant)
    {
        if ($applicant->cv_path) {
            Storage::disk('public')->delete($applicant->cv_path);
        }
        $applicant->delete();

        return redirect()->route('admin.applicants.index')->with('success', 'Applicant record deleted.');
    }
}
