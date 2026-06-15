<x-mail-layout title="We received your message">
    <h1 style="margin:0 0 16px; font-size:20px; color:#0f172a;">Thank you for contacting us</h1>

    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        Dear {{ $contact->name }},
    </p>

    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        Thank you for reaching out to {{ config('app.name') }}. We have received your message
        and a member of our team will get back to you as soon as possible.
    </p>

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin:8px 0 24px; background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:12px;">
        <tr>
            <td style="padding:16px 20px; font-size:13px; line-height:20px; color:#475569;">
                <strong style="color:#0f172a;">Your message</strong><br>
                @if($contact->service_requested)
                    Regarding: {{ $contact->service_requested }}<br>
                @endif
                <span style="white-space:pre-wrap;">{{ $contact->message }}</span>
            </td>
        </tr>
    </table>

    <p style="margin:0; font-size:14px; line-height:22px; color:#334155;">
        Warm regards,<br>
        <strong>{{ config('app.name') }}</strong>
    </p>
</x-mail-layout>
