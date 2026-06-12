@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <a href="{{ route('admin.projects.index') }}" class="block bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-sador-blue hover:-translate-y-1 transition-all duration-300 shadow-xl group">
            <div class="flex justify-between items-start">
                <div class="space-y-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Total Projects</span>
                    <h4 class="text-3xl font-display font-extrabold text-white tracking-tight">{{ $stats['projects'] }}</h4>
                </div>
                <div class="w-12 h-12 bg-sador-blue/10 rounded-2xl flex items-center justify-center text-sador-blue group-hover:bg-sador-blue group-hover:text-white transition-all duration-300">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1.5 text-[10px] font-bold text-sador-blue uppercase tracking-wider">
                Manage Portfolio <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Stat Card 2 -->
        <a href="{{ route('admin.services.index') }}" class="block bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-sador-blue hover:-translate-y-1 transition-all duration-300 shadow-xl group">
            <div class="flex justify-between items-start">
                <div class="space-y-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Services Offered</span>
                    <h4 class="text-3xl font-display font-extrabold text-white tracking-tight">{{ $stats['services'] }}</h4>
                </div>
                <div class="w-12 h-12 bg-sador-blue/10 rounded-2xl flex items-center justify-center text-sador-blue group-hover:bg-sador-blue group-hover:text-white transition-all duration-300">
                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1.5 text-[10px] font-bold text-sador-blue uppercase tracking-wider">
                Manage Services <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Stat Card 3 -->
        <a href="{{ route('admin.messages.index') }}" class="block bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-sador-orange hover:-translate-y-1 transition-all duration-300 shadow-xl group">
            <div class="flex justify-between items-start">
                <div class="space-y-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Unread Messages</span>
                    <h4 class="text-3xl font-display font-extrabold text-white tracking-tight flex items-center gap-2">
                        {{ $stats['unread_messages'] }}
                        @if ($stats['unread_messages'] > 0)
                            <span class="w-2.5 h-2.5 rounded-full bg-sador-orange animate-ping"></span>
                        @endif
                    </h4>
                </div>
                <div class="w-12 h-12 bg-sador-orange/10 rounded-2xl flex items-center justify-center text-sador-orange group-hover:bg-sador-orange group-hover:text-white transition-all duration-300">
                    <i data-lucide="inbox" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1.5 text-[10px] font-bold text-sador-orange uppercase tracking-wider">
                Open Inbox <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <!-- Stat Card 4 -->
        <a href="{{ route('admin.applicants.index') }}" class="block bg-slate-900 border border-slate-800 rounded-3xl p-6 hover:border-sador-orange hover:-translate-y-1 transition-all duration-300 shadow-xl group">
            <div class="flex justify-between items-start">
                <div class="space-y-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500">New Applicants</span>
                    <h4 class="text-3xl font-display font-extrabold text-white tracking-tight flex items-center gap-2">
                        {{ $stats['new_applicants'] }}
                        @if ($stats['new_applicants'] > 0)
                            <span class="w-2.5 h-2.5 rounded-full bg-sador-orange animate-pulse"></span>
                        @endif
                    </h4>
                </div>
                <div class="w-12 h-12 bg-sador-orange/10 rounded-2xl flex items-center justify-center text-sador-orange group-hover:bg-sador-orange group-hover:text-white transition-all duration-300">
                    <i data-lucide="users-2" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1.5 text-[10px] font-bold text-sador-orange uppercase tracking-wider">
                Review Candidates <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>
    </div>

    <!-- Activity Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Messages Panel -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl flex flex-col">
            <div class="px-6 py-5 border-b border-slate-800 flex justify-between items-center bg-slate-950/20">
                <h3 class="font-display font-bold text-sm uppercase tracking-wider text-slate-300 flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4 text-sador-orange"></i> Recent Inquiries
                </h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-sador-orange hover:text-orange-400 transition uppercase tracking-wider">View All</a>
            </div>
            <div class="divide-y divide-slate-800 flex-1">
                @forelse ($recentMessages as $msg)
                    <div class="p-6 flex items-start gap-4 hover:bg-slate-800/20 transition-all duration-200">
                        <div class="w-2 shrink-0 h-2 rounded-full mt-2 {{ $msg->is_read ? 'bg-slate-700' : 'bg-sador-orange animate-pulse' }}"></div>
                        <div class="flex-1 space-y-1">
                            <div class="flex justify-between items-start gap-2">
                                <h4 class="text-xs font-bold text-white">{{ $msg->name }}</h4>
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $msg->service_requested ?? 'General Inquiry' }}</p>
                            <p class="text-xs text-slate-500 font-light line-clamp-2 mt-2 leading-relaxed">"{{ $msg->message }}"</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-600 text-xs">No contact messages received yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applicants Panel -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl flex flex-col">
            <div class="px-6 py-5 border-b border-slate-800 flex justify-between items-center bg-slate-950/20">
                <h3 class="font-display font-bold text-sm uppercase tracking-wider text-slate-300 flex items-center gap-2">
                    <i data-lucide="user-check" class="w-4 h-4 text-sador-blue"></i> Recent Job Applicants
                </h3>
                <a href="{{ route('admin.applicants.index') }}" class="text-xs font-semibold text-sador-blue hover:text-blue-400 transition uppercase tracking-wider">View All</a>
            </div>
            <div class="divide-y divide-slate-800 flex-1">
                @forelse ($recentApplicants as $appl)
                    <div class="p-6 flex items-center justify-between gap-4 hover:bg-slate-800/20 transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-sador-blue/10 text-sador-blue flex items-center justify-center font-bold text-xs uppercase">
                                {{ substr($appl->full_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-white">{{ $appl->full_name }}</h4>
                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $appl->vacancy?->title ?? 'General Speculative' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-2.5 py-1 rounded-lg text-[9px] font-extrabold uppercase tracking-widest border 
                                {{ $appl->status === 'new' ? 'bg-orange-500/10 border-orange-500/20 text-orange-400' : '' }}
                                {{ $appl->status === 'reviewed' ? 'bg-blue-500/10 border-blue-500/20 text-blue-400' : '' }}
                                {{ $appl->status === 'interviewed' ? 'bg-purple-500/10 border-purple-500/20 text-purple-400' : '' }}
                                {{ $appl->status === 'hired' ? 'bg-green-500/10 border-green-500/20 text-green-400' : '' }}
                                {{ $appl->status === 'rejected' ? 'bg-red-500/10 border-red-500/20 text-red-400' : '' }}">
                                {{ $appl->status }}
                            </span>
                            <a href="{{ route('admin.applicants.download', $appl->id) }}" class="p-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl transition border border-slate-700">
                                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-600 text-xs">No job applications submitted yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection