@props(['name', 'label', 'checked' => false, 'id' => null])

<label {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 cursor-pointer select-none']) }}>
    {{-- Hidden field ensures a false value is sent when unchecked --}}
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" id="{{ $id ?? $name }}" value="1" @if($checked) checked @endif class="admin-checkbox">
    <span class="checkbox-mark"></span>
    <span class="text-xs font-semibold text-slate-600">{{ $label }}</span>
</label>
