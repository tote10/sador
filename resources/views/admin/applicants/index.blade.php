@extends('layouts.admin')

@section('title', 'Job Applicants')

@section('content')
<div class="space-y-6">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Candidates Tracker</h3>
        <p class="text-xs text-slate-500 font-light mt-1">Review candidates who applied for job vacancies. Download CVs and update candidate recruitment status.</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/40 border-b border-slate-800 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                        <th class="p-6">Applicant Name</th>
                        <th class="p-6">Vacancy Applied</th>
                        <th class="p-6">Contact Info</th>
                        <th class="p-6">Submitted Date</th>
                        <th class="p-6">CV Document</th>
                        <th class="p-6">Recruitment Status</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    @forelse ($applicants as $appl)
                        <tr class="hover:bg-slate-800/10 transition-colors">
                            <td class="p-6 font-bold text-white">{{ $appl->full_name }}</td>
                            <td class="p-6 font-semibold uppercase tracking-wider text-[10px] text-sador-blue">
                                {{ $appl->vacancy?->title ?? 'General Speculative' }}
                            </td>
                            <td class="p-6 space-y-0.5">
                                <div class="text-slate-300">{{ $appl->email }}</div>
                                <div class="text-slate-500 text-[10px]">{{ $appl->phone }}</div>
                            </td>
                            <td class="p-6 text-slate-400 font-semibold">{{ $appl->created_at->format('M d, Y') }}</td>
                            <td class="p-6">
                                @if ($appl->cv_path)
                                    <a href="{{ route('admin.applicants.download', $appl->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sador-blue/20 hover:bg-sador-blue/30 text-sador-blue text-[10px] font-extrabold uppercase tracking-wider rounded-xl transition border border-sador-blue/20">
                                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Download CV
                                    </a>
                                @else
                                    <span class="text-slate-650">No Document</span>
                                @endif
                            </td>
                            <td class="p-6">
                                <form action="{{ route('admin.applicants.status', $appl->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="bg-slate-950/60 border border-slate-800 rounded-lg text-slate-300 text-[10px] font-extrabold uppercase tracking-wider px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-sador-orange/50">
                                        <option value="new" {{ $appl->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="reviewed" {{ $appl->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="interviewed" {{ $appl->status === 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                                        <option value="hired" {{ $appl->status === 'hired' ? 'selected' : '' }}>Hired</option>
                                        <option value="rejected" {{ $appl->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <!-- Quick Details Trigger Modal -->
                                    <div x-data="{ detailsOpen: false }" class="inline">
                                        <button @click="detailsOpen = true" class="p-2 bg-slate-800 hover:bg-slate-700 hover:text-white text-slate-400 rounded-lg transition border border-slate-700 flex items-center">
                                            <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                        </button>
                                        
                                        <!-- Modal backdrop and content -->
                                        <div x-show="detailsOpen" 
                                             class="fixed inset-0 z-50 flex items-center justify-center p-4" 
                                             style="display: none;">
                                            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="detailsOpen = false"></div>
                                            
                                            <div class="relative bg-slate-900 border border-slate-850 w-full max-w-lg rounded-3xl p-8 text-left shadow-2xl space-y-6">
                                                <div>
                                                    <h3 class="font-display font-extrabold text-sm uppercase tracking-wider text-white">Applicant Statement</h3>
                                                    <p class="text-[10px] text-slate-500 font-light mt-0.5">Submitted statement from {{ $appl->full_name }}</p>
                                                </div>
                                                
                                                <div class="bg-slate-950/40 border border-slate-850 p-6 rounded-2xl text-xs text-slate-300 leading-relaxed font-light whitespace-pre-wrap max-h-60 overflow-y-auto">
                                                    {{ $appl->message ?? 'No candidate statement submitted.' }}
                                                </div>
                                                
                                                <div class="flex justify-end pt-4 border-t border-slate-850">
                                                    <button @click="detailsOpen = false" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-750 text-xs font-bold uppercase tracking-wider text-slate-300 hover:text-white border border-slate-700 rounded-xl transition">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('admin.applicants.destroy', $appl->id) }}" method="POST" onsubmit="return confirm('Delete this applicant record?');" class="inline">
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
                            <td colspan="7" class="p-8 text-center text-slate-600">No applicants registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($applicants->hasPages())
            <div class="p-6 border-t border-slate-800 bg-slate-950/20">
                {{ $applicants->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
