{{-- Shared email shell (anonymous Blade component). Inline styles only — email clients ignore <style>. --}}
@props(['title' => null])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f1f5f9; font-family:Arial, Helvetica, sans-serif; color:#1e293b;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#0f172a; padding:28px 32px;">
                            <span style="font-size:18px; font-weight:bold; letter-spacing:1px; color:#ffffff; text-transform:uppercase;">
                                {{ config('app.name', 'Sador General Construction') }}
                            </span>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:32px;">
                            {{ $slot }}
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f8fafc; padding:24px 32px; border-top:1px solid #e2e8f0;">
                            <p style="margin:0; font-size:12px; line-height:18px; color:#94a3b8;">
                                {{ config('app.name', 'Sador General Construction') }}<br>
                                This is an automated message. You can reply directly to this email if you need to reach us.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
