@props(['route', 'label' => 'Back'])

<a href="{{ $route }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-sador-blue transition mb-5">
    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
    {{ $label }}
</a>
