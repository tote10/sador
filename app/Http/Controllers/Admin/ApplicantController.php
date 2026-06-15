<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminReply;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

    /**
     * Send an admin-authored reply to the applicant. The body is pre-filled from a
     * template on the front-end, but the admin can edit it freely before sending.
     * Optionally updates the recruitment status in the same action.
     */
    public function reply(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'nullable|in:new,reviewed,interviewed,hired,rejected',
        ]);

        try {
            Mail::to($applicant->email)->send(new AdminReply(
                recipientName: $applicant->full_name,
                subjectLine: $validated['subject'],
                bodyContent: $validated['body'],
            ));
        } catch (\Throwable $e) {
            Log::error('Failed to send applicant reply email: ' . $e->getMessage());
            return back()->with('error', 'Could not send the email. Please check your mail settings and try again.');
        }

        // If the admin chose a status alongside the reply, apply it too.
        if (!empty($validated['status'])) {
            $applicant->update(['status' => $validated['status']]);
        }

        return back()->with('success', 'Your reply was sent to ' . $applicant->full_name . '.');
    }

    public function downloadCv(Applicant $applicant)
    {
        if (!$applicant->cv_path || !Storage::disk('local')->exists($applicant->cv_path)) {
            return back()->with('error', 'CV file not found on server.');
        }

        return Storage::disk('local')->download($applicant->cv_path, $applicant->full_name . ' - CV.' . pathinfo($applicant->cv_path, PATHINFO_EXTENSION));
    }

    public function destroy(Applicant $applicant)
    {
        if ($applicant->cv_path) {
            Storage::disk('local')->delete($applicant->cv_path);
        }
        $applicant->delete();

        return redirect()->route('admin.applicants.index')->with('success', 'Applicant record deleted.');
    }

    /**
     * Applicants have no read/unread flag — the equivalent of "mark all as read"
     * is acknowledging every NEW application by moving it to "reviewed". No emails are sent.
     */
    public function markAllReviewed()
    {
        $count = Applicant::where('status', 'new')->update(['status' => 'reviewed']);
        return back()->with('success', $count . ' new applicant(s) marked as reviewed.');
    }

    public function destroyAll()
    {
        // Remove stored CV files first, then the records.
        Applicant::whereNotNull('cv_path')->get()->each(function (Applicant $applicant) {
            Storage::disk('local')->delete($applicant->cv_path);
        });

        $count = Applicant::count();
        Applicant::query()->delete();

        return back()->with('success', $count . ' applicant record(s) deleted.');
    }
}
