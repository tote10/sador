@extends('layouts.admin')

@section('title', 'Inbox Messages')

@section('content')
<div class="space-y-6">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Inbox</h3>
        <p class="text-xs text-slate-500 font-light mt-1">Review contact form inquiries sent by public users.</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/40 border-b border-slate-800 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                        <th class="p-6">Status</th>
                        <th class="p-6">Sender Name</th>
                        <th class="p-6">Email / Phone</th>
                        <th class="p-6">Requested Service</th>
                        <th class="p-6">Date</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    @forelse ($messages as $msg)
                        <tr class="hover:bg-slate-800/10 transition-colors {{ $msg->is_read ? 'opacity-70' : 'font-bold' }}">
                            <td class="p-6">
                                <span class="inline-flex items-center justify-center w-2.5 h-2.5 rounded-full {{ $msg->is_read ? 'bg-slate-700' : 'bg-sador-orange animate-pulse' }}"></span>
                            </td>
                            <td class="p-6 text-white">{{ $msg->name }}</td>
                            <td class="p-6 space-y-0.5">
                                <div class="text-slate-300">{{ $msg->email }}</div>
                                <div class="text-slate-500 text-[10px]">{{ $msg->phone ?? 'No Phone' }}</div>
                            </td>
                            <td class="p-6">
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-widest bg-sador-blue/10 border border-sador-blue/20 text-sador-blue">
                                    {{ $msg->service_requested ?? 'General' }}
                                </span>
                            </td>
                            <td class="p-6 text-slate-400 font-semibold">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="p-2 bg-slate-800 hover:bg-slate-700 hover:text-white text-slate-400 rounded-lg transition border border-slate-700 flex items-center">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-500/10 hover:bg-red-500 hover:text-white text-red-400 rounded-lg transition border border-red-500/20 flex items-center">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-600">No messages received yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($messages->hasPages())
            <div class="p-6 border-t border-slate-800 bg-slate-950/20">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
