@extends('layouts.admin')

@section('title', 'Read Message')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex justify-between items-center bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <div>
            <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Message Details</h3>
            <p class="text-xs text-slate-500 font-light mt-1">Received from {{ $message->name }} on {{ $message->created_at->format('F d, Y \a\t H:i') }}</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-xs font-bold uppercase tracking-wider text-slate-300 hover:text-white rounded-xl border border-slate-700 transition">
            Back to Inbox
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-6">
        <!-- Sender Header Card -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 bg-slate-950/40 p-6 rounded-2xl border border-slate-850">
            <div>
                <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-500">Sender</span>
                <h4 class="text-xs font-bold text-white mt-1">{{ $message->name }}</h4>
            </div>
            <div>
                <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-500">Email Address</span>
                <h4 class="text-xs font-bold text-white mt-1">
                    <a href="mailto:{{ $message->email }}" class="text-sador-blue hover:underline">{{ $message->email }}</a>
                </h4>
            </div>
            <div>
                <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-500">Phone Number</span>
                <h4 class="text-xs font-bold text-white mt-1">{{ $message->phone ?? 'Not Provided' }}</h4>
            </div>
            <div class="sm:col-span-3 border-t border-slate-800 pt-4">
                <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-500">Requested Service / Area</span>
                <h4 class="text-xs font-bold text-white mt-1 uppercase tracking-wider text-sador-orange">{{ $message->service_requested ?? 'General Inquiry' }}</h4>
            </div>
        </div>

        <!-- Message Body -->
        <div class="space-y-3">
            <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-500">Message Content</span>
            <div class="bg-slate-950/20 border border-slate-850 rounded-2xl p-6 text-slate-200 text-xs leading-relaxed whitespace-pre-wrap">
                "{{ $message->message }}"
            </div>
        </div>

        <!-- Actions -->
        <div class="border-t border-slate-800 pt-6 flex justify-end gap-3">
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message permanently?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-3 bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white text-xs font-bold uppercase tracking-wider rounded-xl border border-red-500/20 transition flex items-center gap-2">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Delete Inquiry
                </button>
            </form>
            <a href="mailto:{{ $message->email }}?subject=RE: {{ rawurlencode($message->service_requested ?? 'General Inquiry') }}" class="px-6 py-3 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4"></i> Reply Email
            </a>
        </div>
    </div>
</div>
@endsection
