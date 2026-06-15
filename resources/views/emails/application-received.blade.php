<x-mail-layout title="Application Received">
    <h1 style="margin:0 0 16px; font-size:20px; color:#0f172a;">Thank you for your application</h1>

    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        Dear {{ $applicant->full_name }},
    </p>

    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        @if($applicant->vacancy)
            We have received your application for the position of <strong>{{ $applicant->vacancy->title }}</strong>.
        @else
            We have received your application.
        @endif
        Thank you for your interest in joining {{ config('app.name') }}.
    </p>

    <p style="margin:0 0 16px; font-size:14px; line-height:22px; color:#334155;">
        Our recruitment team will carefully review your details. If your profile matches our
        requirements, we will contact you regarding the next steps. We appreciate your patience
        during the review process.
    </p>

    <table role="presentation" cellpadding="0" cellspacing="0" style="margin:8px 0 24px; background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:12px;">
        <tr>
            <td style="padding:16px 20px; font-size:13px; line-height:20px; color:#475569;">
                <strong style="color:#0f172a;">Application summary</strong><br>
                Name: {{ $applicant->full_name }}<br>
                Position: {{ $applicant->vacancy?->title ?? 'General / Speculative application' }}<br>
                Submitted: {{ $applicant->created_at->format('F d, Y') }}
            </td>
        </tr>
    </table>

    <p style="margin:0; font-size:14px; line-height:22px; color:#334155;">
        Warm regards,<br>
        <strong>The Recruitment Team</strong><br>
        {{ config('app.name') }}
    </p>
</x-mail-layout>
