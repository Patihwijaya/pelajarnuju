<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background-color:#098b67; padding:24px 32px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:22px; letter-spacing:1px;">Reset Password</h1>
                            <p style="margin:6px 0 0; color:#d1fae5; font-size:13px;">Ikatan Pelajar Nahdlatul Ulama Jakarta Utara</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px; text-align:center;">
                            <p style="margin:0 0 16px; color:#374151; font-size:15px; line-height:1.6;">
                                Anda menerima email ini karena ada permintaan reset password untuk akun
                                <strong style="color:#098b67;">{{ $email }}</strong>.
                            </p>
                            <p style="margin:0 0 24px; color:#374151; font-size:15px; line-height:1.6;">
                                Klik tombol di bawah ini untuk membuat password baru.
                            </p>

                            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}"
                               style="display:inline-block; background-color:#098b67; color:#ffffff; text-decoration:none; font-size:15px; font-weight:bold; padding:14px 32px; border-radius:8px;">
                                Reset Password
                            </a>

                            <p style="margin:24px 0 0; color:#6b7280; font-size:13px; line-height:1.6;">
                                Tautan berlaku selama <strong style="color:#dc2626;">60 menit</strong> dan hanya bisa dipakai sekali.
                                Jika Anda tidak meminta reset password, abaikan email ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#f9fafb; padding:16px 32px; text-align:center; border-top:1px solid #e5e7eb;">
                            <p style="margin:0; color:#9ca3af; font-size:12px;">
                                © {{ date('Y') }} PC IPNU &amp; IPPNU Jakarta Utara. Semua hak dilindungi.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
