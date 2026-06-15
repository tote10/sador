<x-mail-layout :title="$subjectLine ?? config('app.name')">
    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        Dear {{ $recipientName }},
    </p>

    {{-- Admin-authored body. nl2br + e() keeps line breaks while escaping HTML. --}}
    <div style="margin:0 0 24px; font-size:14px; line-height:22px; color:#334155;">
        {!! nl2br(e($bodyContent)) !!}
    </div>

    <p style="margin:0; font-size:14px; line-height:22px; color:#334155;">
        Warm regards,<br>
        <strong>{{ config('app.name') }}</strong>
    </p>
</x-mail-layout>
