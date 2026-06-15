@extends('layouts.admin')

@section('title', 'Job Applicants')

@section('content')
<div class="space-y-6">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Candidates Tracker</h3>
            <p class="text-xs text-slate-500 font-light mt-1">Review candidates who applied for job vacancies. Download CVs and update candidate recruitment status. Changing the status lets you email the candidate.</p>
        </div>
        @if ($applicants->total() > 0)
            <div class="flex items-center gap-2 shrink-0">
                <form action="{{ route('admin.applicants.reviewAll') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 bg-sador-blue/10 hover:bg-sador-blue/20 text-sador-blue text-[10px] font-extrabold uppercase tracking-wider rounded-xl transition border border-sador-blue/20" title="Move all New applicants to Reviewed (no emails sent)">
                        <i data-lucide="check-check" class="w-3.5 h-3.5"></i> Mark all reviewed
                    </button>
                </form>
                <form action="{{ route('admin.applicants.destroyAll') }}" method="POST" onsubmit="return confirm('Delete ALL applicant records and their CVs permanently? This cannot be undone.');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-500/10 hover:bg-red-500 hover:text-white text-red-400 text-[10px] font-extrabold uppercase tracking-wider rounded-xl transition border border-red-500/20">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Delete all
                    </button>
                </form>
            </div>
        @endif
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
                        @php
                            $position = $appl->vacancy?->title ?? 'the position you applied for';
                            $company = config('app.name');
                            // Pre-written, editable emails keyed by the status that triggers them.
                            $statusEmails = [
                                'reviewed' => [
                                    'subject' => 'Your application is under review — ' . $company,
                                    'body' => "Thank you for your application for {$position}. We wanted to let you know that your application is currently under review by our recruitment team.\n\nWe will be in touch with the next steps as soon as the review is complete. Thank you for your patience.",
                                ],
                                'interviewed' => [
                                    'subject' => 'Interview Invitation — ' . ($appl->vacancy?->title ?? 'Your Application'),
                                    'body' => "We were impressed by your application for {$position} and would like to invite you to an interview.\n\nPlease reply with your availability over the coming days and we will arrange a suitable time. The interview may be held at our office or online.\n\nWe look forward to speaking with you.",
                                ],
                                'hired' => [
                                    'subject' => 'Job Offer — ' . ($appl->vacancy?->title ?? 'Your Application'),
                                    'body' => "Congratulations! Following our review, we are pleased to offer you the role of {$position} at {$company}.\n\nOur team will be in touch shortly with the details of your offer and the next steps. We are excited to welcome you on board.",
                                ],
                                'rejected' => [
                                    'subject' => 'Update on your application — ' . $company,
                                    'body' => "Thank you for taking the time to apply for {$position} and for your interest in {$company}.\n\nAfter careful consideration, we have decided to proceed with other candidates at this time. This was a difficult decision and we genuinely appreciate the effort you put into your application.\n\nWe wish you every success in your job search and encourage you to apply for future openings.",
                                ],
                            ];
                            $statusLabels = [
                                'reviewed' => 'Under Review',
                                'interviewed' => 'Interview Invitation',
                                'hired' => 'Job Offer',
                                'rejected' => 'Application Update',
                            ];
                        @endphp
                        <tr class="hover:bg-slate-800/10 transition-colors"
                            x-data="{
                                current: @js($appl->status),
                                selected: @js($appl->status),
                                replyOpen: false,
                                subject: '',
                                body: '',
                                emails: @js($statusEmails),
                                labels: @js($statusLabels),
                                onChange() {
                                    if (this.selected === this.current) return;
                                    // 'new' (or any status without a template) just updates silently — no email.
                                    if (!this.emails[this.selected]) { this.$refs.statusForm.submit(); return; }
                                    this.subject = this.emails[this.selected].subject;
                                    this.body = this.emails[this.selected].body;
                                    this.replyOpen = true;
                                },
                                cancel() { this.replyOpen = false; this.selected = this.current; }
                            }">
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
                                {{-- Hidden status-only form, submitted by Alpine only when switching to "New". --}}
                                <form x-ref="statusForm" action="{{ route('admin.applicants.status', $appl->id) }}" method="POST" class="hidden">
                                    @csrf
                                    <input type="hidden" name="status" :value="selected">
                                </form>
                                <select x-model="selected" @change="onChange()" class="bg-slate-950/60 border border-slate-800 rounded-lg text-slate-300 text-[10px] font-extrabold uppercase tracking-wider px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-sador-orange/50">
                                    <option value="new">New</option>
                                    <option value="reviewed">Reviewed</option>
                                    <option value="interviewed">Interviewed</option>
                                    <option value="hired">Hired</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <p class="text-[9px] text-slate-600 mt-1.5 leading-tight">Emails the candidate.</p>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    {{-- Reply composer — opened automatically when the status dropdown changes. --}}
                                    <div x-show="replyOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
                                        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="cancel()"></div>

                                        <form action="{{ route('admin.applicants.reply', $appl->id) }}" method="POST"
                                              class="relative bg-slate-900 border border-slate-850 w-full max-w-lg rounded-3xl p-8 text-left shadow-2xl space-y-5">
                                            @csrf
                                            <input type="hidden" name="status" :value="selected">
                                            <div>
                                                <h3 class="font-display font-extrabold text-sm uppercase tracking-wider text-white">
                                                    <span x-text="labels[selected] ?? 'Email'"></span> — {{ $appl->full_name }}
                                                </h3>
                                                <p class="text-[10px] text-slate-500 font-light mt-0.5">
                                                    Sending to {{ $appl->email }} · status will be set to <span class="uppercase font-bold text-sador-orange" x-text="selected"></span>
                                                </p>
                                            </div>

                                            <div>
                                                <label class="block text-[9px] font-extrabold uppercase tracking-widest text-slate-500 mb-1.5">Subject</label>
                                                <input type="text" name="subject" x-model="subject" required class="w-full bg-slate-950/60 border border-slate-800 rounded-xl text-slate-200 text-xs px-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-sador-orange/50">
                                            </div>

                                            <div>
                                                <label class="block text-[9px] font-extrabold uppercase tracking-widest text-slate-500 mb-1.5">Message</label>
                                                <textarea name="body" x-model="body" rows="8" required class="w-full bg-slate-950/60 border border-slate-800 rounded-xl text-slate-200 text-xs px-3 py-2.5 leading-relaxed focus:outline-none focus:ring-1 focus:ring-sador-orange/50"></textarea>
                                                <p class="text-[10px] text-slate-600 mt-1.5">Edit the message freely before sending. The greeting and signature are added automatically.</p>
                                            </div>

                                            <div class="flex justify-end gap-3 pt-4 border-t border-slate-850">
                                                <button type="button" @click="cancel()" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-750 text-xs font-bold uppercase tracking-wider text-slate-300 hover:text-white border border-slate-700 rounded-xl transition">Cancel</button>
                                                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-display font-extrabold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition flex items-center gap-2">
                                                    <i data-lucide="send" class="w-3.5 h-3.5"></i> Send &amp; Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>

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
