<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminReply;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    /**
     * Send an admin-authored reply to the person who submitted the contact message.
     * Subject/body are pre-filled in the form but fully editable before sending.
     */
    public function reply(Request $request, Message $message)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        try {
            Mail::to($message->email)->send(new AdminReply(
                recipientName: $message->name,
                subjectLine: $validated['subject'],
                bodyContent: $validated['body'],
            ));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact reply email: ' . $e->getMessage());
            return back()->with('error', 'Could not send the email. Please check your mail settings and try again.');
        }

        return back()->with('success', 'Your reply was sent to ' . $message->name . '.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }

    public function markAllRead()
    {
        $count = Message::where('is_read', false)->update(['is_read' => true]);
        return back()->with('success', $count . ' message(s) marked as read.');
    }

    public function destroyAll()
    {
        $count = Message::count();
        Message::query()->delete();
        return back()->with('success', $count . ' message(s) deleted.');
    }
}
