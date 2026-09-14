<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Pendaftaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 0;
        }
        .email-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: #0f172a; /* Warna dark biru senada dengan sidebar Anda */
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 20px;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .content {
            padding: 32px;
            text-align: center;
        }
        .content h2 {
            font-size: 22px;
            color: #111827;
            margin-top: 0;
            margin-bottom: 16px;
        }
        .content p {
            font-size: 15px;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 24px;
        }
        .otp-box {
            display: inline-block;
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 16px 32px;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #1d4ed8; /* Biru terang agar mencolok */
            margin-bottom: 24px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header Email -->
            <div class="header">
                <img src="{{ $message->embed(public_path('asset/logo pelajarnuju putih.png')) }}" alt="Logo Pelajarnuju" width="220" style="width: 220px; max-width: 100%; height: auto; margin: 0 auto; display: block;">
            </div>
            
            <!-- Isi Email -->
            <div class="content">
                <h2>Verifikasi Email Anda</h2>
                <p>Hallo Rekan/Rekanita,</p>
                <p>Terima kasih telah melakukan pendaftaran di portal PC IPNU IPPNU Jakarta Utara. Untuk menyelesaikan proses registrasi, silakan masukkan kode verifikasi berikut:</p>
                
                <!-- Kotak Kode OTP -->
                <div class="otp-box">
                    {{ $otpCode }}
                </div>
                
                <p>Kode ini bersifat rahasia dan hanya berlaku selama <strong>10 menit</strong>. Jangan berikan kode ini kepada siapapun.</p>
            </div>
            
            <!-- Footer Email -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} PC IPNU IPPNU Jakarta Utara. All rights reserved.</p>
                <p style="margin-top: 8px; font-size: 11px;">Ini adalah email otomatis, mohon tidak membalas email ini.</p>
            </div>
        </div>
    </div>
</body>
</html>