@props(['name', 'label', 'checked' => false, 'id' => null])

<label {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 cursor-pointer select-none']) }}>
    <input type="radio" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ $label }}" @if($checked) checked @endif class="admin-radio" />
    <span class="text-xs font-semibold text-slate-600">{{ $label }}</span>
</label>
