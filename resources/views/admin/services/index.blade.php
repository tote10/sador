@extends('layouts.admin')

@section('title', 'Manage Services')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl">
        <div>
            <h3 class="text-sm font-display font-extrabold text-white uppercase tracking-wider">Company Services</h3>
            <p class="text-xs text-slate-500 font-light mt-1">Manage core services and competencies shown to public users.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-sador-orange to-amber-500 hover:opacity-95 text-xs font-bold uppercase tracking-widest text-white rounded-xl shadow-lg shadow-sador-orange/20 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Add Service
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/40 border-b border-slate-800 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                        <th class="p-6">Image</th>
                        <th class="p-6">Service Title</th>
                        <th class="p-6">Short Description</th>
                        <th class="p-6">Featured</th>
                        <th class="p-6">Published</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-800/10 transition-colors">
                            <td class="p-6">
                                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-800 border border-slate-700">
                                    @if ($service->image_url)
                                        <img src="{{ $service->image_url }}" class="w-full h-full object-cover" alt="{{ $service->title }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-600">
                                            <i data-lucide="image" class="w-4 h-4"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-6 font-bold text-white max-w-xs truncate">{{ $service->title }}</td>
                            <td class="p-6 text-slate-400 max-w-sm truncate">{{ $service->short_description }}</td>
                            <td class="p-6">
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-widest {{ $service->is_featured ? 'bg-orange-500/10 text-orange-400 border border-orange-500/20' : 'bg-slate-800 text-slate-500' }}">
                                    {{ $service->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="p-6">
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-widest {{ $service->is_published ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    {{ $service->is_published ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="p-2 bg-slate-800 hover:bg-slate-700 hover:text-white text-slate-400 rounded-lg transition border border-slate-700 flex items-center">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline">
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
                            <td colspan="6" class="p-8 text-center text-slate-600">No services added yet. Click "Add Service" to begin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($services->hasPages())
            <div class="p-6 border-t border-slate-800 bg-slate-950/20">
                {{ $services->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
