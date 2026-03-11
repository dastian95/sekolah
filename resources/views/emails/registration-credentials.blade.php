<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Pendaftaran</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #1a3a5c 0%, #2d5a8c 100%); padding: 30px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700;">{{ $schoolName }}</h1>
                <p style="color: #ffd700; margin: 8px 0 0 0; font-size: 14px; font-weight: 600;">Iman - Ilmu - Amal</p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <!-- Greeting -->
                <h2 style="color: #1a3a5c; margin: 0 0 10px 0; font-size: 20px;">Assalamu'alaikum Wr. Wb.</h2>
                <p style="color: #555; line-height: 1.6; margin: 0 0 20px 0;">
                    Terima kasih telah mendaftarkan putra/putri Anda, <strong>{{ $studentName }}</strong>, di {{ $schoolName }}. 
                    Pendaftaran Anda telah berhasil diproses.
                </p>

                <!-- Registration Number -->
                <div style="background-color: #e8f4fd; border-left: 4px solid #0066cc; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                    <p style="margin: 0; color: #1a3a5c; font-weight: 600;">
                        📋 Nomor Registrasi: <span style="font-size: 18px; color: #0066cc;">{{ $registrationNumber }}</span>
                    </p>
                </div>

                <!-- Account Credentials -->
                <h3 style="color: #1a3a5c; margin: 25px 0 15px 0; font-size: 18px;">🔑 Informasi Akun Siswa</h3>
                <p style="color: #555; line-height: 1.6; margin: 0 0 15px 0;">
                    Berikut adalah informasi akun yang dapat digunakan untuk login ke Portal Siswa:
                </p>

                <table width="100%" cellpadding="0" cellspacing="0" style="border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden; margin-bottom: 20px;">
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 12px 18px; width: 40%; border-bottom: 1px solid #e0e0e0;">
                            <strong style="color: #1a3a5c;">Username</strong>
                        </td>
                        <td style="padding: 12px 18px; border-bottom: 1px solid #e0e0e0;">
                            <code style="background-color: #e8f4fd; padding: 4px 10px; border-radius: 4px; font-size: 16px; font-weight: 700; color: #0066cc;">{{ $username }}</code>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 12px 18px; width: 40%;">
                            <strong style="color: #1a3a5c;">Password</strong>
                        </td>
                        <td style="padding: 12px 18px;">
                            <code style="background-color: #e8f4fd; padding: 4px 10px; border-radius: 4px; font-size: 16px; font-weight: 700; color: #0066cc;">{{ $plainPassword }}</code>
                        </td>
                    </tr>
                </table>

                <!-- Login URL -->
                <div style="text-align: center; margin: 25px 0;">
                    <a href="{{ url('/login') }}" style="display: inline-block; background: linear-gradient(135deg, #0066cc, #0052a3); color: #ffffff; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 16px;">
                        🚀 Login ke Portal Siswa
                    </a>
                </div>

                <!-- Warning Box -->
                <div style="background-color: #fff3cd; border: 1px solid #ffc107; border-left: 4px solid #ff9800; padding: 18px; border-radius: 8px; margin: 25px 0;">
                    <h4 style="color: #856404; margin: 0 0 10px 0; font-size: 16px;">
                        ⚠️ PERINGATAN KEAMANAN
                    </h4>
                    <ul style="color: #856404; margin: 0; padding-left: 20px; line-height: 1.8;">
                        <li><strong>JANGAN</strong> membagikan username dan password Anda kepada siapapun.</li>
                        <li><strong>JANGAN</strong> menyimpan informasi akun di tempat yang mudah diakses orang lain.</li>
                        <li>Segera <strong>ganti password</strong> Anda setelah login pertama kali.</li>
                        <li>Jika Anda merasa akun Anda diakses oleh orang lain, segera hubungi pihak sekolah.</li>
                        <li>Pihak sekolah <strong>TIDAK PERNAH</strong> meminta password Anda melalui telepon, SMS, atau media lainnya.</li>
                    </ul>
                </div>

                <!-- Status Info -->
                <div style="background-color: #f8f9fa; padding: 18px; border-radius: 8px; margin: 20px 0;">
                    <h4 style="color: #1a3a5c; margin: 0 0 10px 0; font-size: 16px;">📌 Status Pendaftaran</h4>
                    <p style="color: #555; margin: 0; line-height: 1.6;">
                        Status pendaftaran Anda saat ini: <strong style="color: #ff9800;">Menunggu Konfirmasi</strong>.<br>
                        Tim kami akan segera memproses dan menghubungi Anda. Anda dapat mengecek status pendaftaran melalui Portal Siswa.
                    </p>
                </div>

                <p style="color: #555; line-height: 1.6; margin: 20px 0 0 0;">
                    Jika ada pertanyaan, silakan hubungi kami melalui email atau telepon yang tercantum di website sekolah.
                </p>

                <p style="color: #555; line-height: 1.6; margin: 15px 0 0 0;">
                    Wassalamu'alaikum Wr. Wb.<br>
                    <strong style="color: #1a3a5c;">Tim PPDB {{ $schoolName }}</strong>
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #1a3a5c; padding: 20px; text-align: center;">
                <p style="color: rgba(255,255,255,0.7); margin: 0; font-size: 12px;">
                    &copy; {{ date('Y') }} {{ $schoolName }}. Semua hak dilindungi.
                </p>
                <p style="color: rgba(255,255,255,0.5); margin: 8px 0 0 0; font-size: 11px;">
                    Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
