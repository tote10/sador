@extends('layouts.admin')

@section('title', 'Manage Partners')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <div>
            <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Trusted Partners</h3>
            <p class="text-xs text-slate-500 font-light mt-1">Manage the partner logos shown in the "Confidence of Hundreds" homepage strip.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-bold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Add Partner
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/40 border-b border-slate-800 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                        <th class="p-6">Logo</th>
                        <th class="p-6">Partner Name</th>
                        <th class="p-6">Role / Label</th>
                        <th class="p-6">Order</th>
                        <th class="p-6">Published</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    @forelse ($partners as $partner)
                        <tr class="hover:bg-slate-800/10 transition-colors">
                            <td class="p-6">
                                <div class="w-10 h-10 rounded-xl overflow-hidden border border-slate-700 flex items-center justify-center p-1 bg-white">
                                    @if ($partner->logo_url)
                                        <img src="{{ $partner->logo_url }}" class="w-full h-full object-contain" alt="{{ $partner->name }}">
                                    @else
                                        <i data-lucide="building-2" class="w-5 h-5 text-slate-500"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="p-6 font-bold text-white max-w-xs truncate">{{ $partner->name }}</td>
                            <td class="p-6 text-slate-400 max-w-xs truncate">{{ $partner->role_label }}</td>
                            <td class="p-6 text-slate-400 font-semibold">{{ $partner->sort_order }}</td>
                            <td class="p-6">
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-widest {{ $partner->is_published ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    {{ $partner->is_published ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}" class="p-2 bg-slate-800 hover:bg-slate-700 hover:text-white text-slate-400 rounded-lg transition border border-slate-700 flex items-center">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this partner?');" class="inline">
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
                            <td colspan="6" class="p-8 text-center text-slate-600">No partners added yet. Click "Add Partner" to begin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($partners->hasPages())
            <div class="p-6 border-t border-slate-800 bg-slate-950/20">
                {{ $partners->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
