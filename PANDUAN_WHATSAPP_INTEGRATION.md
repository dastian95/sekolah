# 🔔 Panduan Integrasi WhatsApp Notification

Dokumen ini menjelaskan cara mengintegrasikan sistem notifikasi WhatsApp ke portal siswa.

---

## 1. Opsi Integrasi WhatsApp

### Opsi 1: Twilio WhatsApp API (Recommended)

**Kelebihan:**

- ✅ Mudah diimplementasikan
- ✅ Reliable dan stabil
- ✅ Good documentation
- ✅ Free tier tersedia (trial credits $15)

**Biaya:**

- Twililo merupakan paid service
- Estimasi: $0.01-$0.05 per pesan
- Gratis 30 hari trial

**Setup:**

1. Register di https://www.twilio.com
2. Ambil API credentials (Account SID, Auth Token)
3. Install package: `composer require twilio/sdk`
4. Konfigurasi di `.env`

### Opsi 2: WhatsApp Business API

**Kelebihan:**

- ✅ Official WhatsApp platform
- ✅ Full features
- ✅ Better security

**Kekurangan:**

- ❌ Proses approval panjang
- ❌ Dibutuhkan bisnis terverifikasi
- ❌ Setup kompleks

### Opsi 3: Custom Integration (Tidak Disarankan)

**Kelebihan:**

- ✅ Full control
- ✅ No third-party dependency

**Kekurangan:**

- ❌ Kompleks
- ❌ WhatsApp tidak support custom bot
- ❌ Rentan blocked

---

## 2. Setup Twilio WhatsApp

### Step 1: Install Package

```bash
composer require twilio/sdk
```

### Step 2: Konfigurasi `.env`

```env
TWILIO_ACCOUNT_SID=your_account_sid
TWILIO_AUTH_TOKEN=your_auth_token
TWILIO_PHONE_NUMBER=whatsapp:+62xxxxxxxxxx
```

### Step 3: Update Notification Class

Modify `app/Notifications/StudentStatusUpdated.php`:

```php
<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class StudentStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Student $student,
        public string $oldStatus,
        public string $newStatus
    ) {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['whatsapp'];
    }

    /**
     * Send WhatsApp message via Twilio
     */
    public function toWhatsApp(object $notifiable)
    {
        $twilio = new Client(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_AUTH_TOKEN')
        );

        $message = $this->getMessage();

        try {
            $twilio->messages->create(
                $this->formatPhoneNumber($this->student->hp),
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => $message,
                ]
            );
        } catch (\Exception $e) {
            \Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }
    }

    /**
     * Get message based on status
     */
    private function getMessage(): string
    {
        return match($this->newStatus) {
            'pending' => "Halo {$this->student->nama}!\n\nPendaftaran Anda telah diterima. Kami akan memverifikasi data Anda dan menghubungi dalam waktu singkat.\n\nTerima kasih.",

            'contacted' => "Halo {$this->student->nama}!\n\nAdmin sekolah akan segera menghubungimu untuk verifikasi data pendaftaran.\n\nSilakan pastikan nomor HP ini aktif.\n\nTerima kasih.",

            'verified' => "🎉 Selamat {$this->student->nama}!\n\nKamu dinyatakan LULUS!\n\nSilakan login ke portal siswa untuk download sertifikat kelulusan.\n\nURL: https://sekolah.sch.id/student/graduation-status",

            'rejected' => "Pemberitahuan untuk {$this->student->nama}\n\nMohon maaf, kamu belum dinyatakan lulus berdasarkan hasil evaluasi.\n\nSilakan hubungi sekolah untuk informasi lebih lanjut.\n\nKontak: admin@sekolah.sch.id",

            default => "Ada update status untuk {$this->student->nama}"
        };
    }

    /**
     * Format phone number for Twilio
     * Input: 081234567890 → Output: whatsapp:+6281234567890
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Remove non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If starts with 0, replace with country code
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Add WhatsApp prefix
        return 'whatsapp:+' . $phone;
    }
}
```

### Step 4: Send Notification

Di AdminStudentController, saat update status:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Notifications\StudentStatusUpdated;

class AdminStudentController extends Controller
{
    public function updateStatus(Student $student, Request $request)
    {
        $oldStatus = $student->status;
        $newStatus = $request->input('status');

        // Update student status
        $student->update([
            'status' => $newStatus,
            'admin_note' => $request->input('admin_note'),
        ]);

        // Send WhatsApp notification
        $student->notify(new StudentStatusUpdated($student, $oldStatus, $newStatus));

        return redirect()->back()->with('success', 'Status siswa berhasil diupdate dan notifikasi WhatsApp terkirim.');
    }
}
```

---

## 3. Implementasi Lengkap di AdminStudentController

Update file `app/Http/Controllers/AdminStudentController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Notifications\StudentStatusUpdated;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    /**
     * Show list of students with pagination
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Update student status and send notification
     */
    public function updateStatus(Student $student, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,verified,rejected',
            'admin_note' => 'nullable|string',
            'nilai_akhir' => 'nullable|numeric|min:0|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $oldStatus = $student->status;
        $newStatus = $request->input('status');

        // Update student record
        $student->update([
            'status' => $newStatus,
            'admin_note' => $request->input('admin_note'),
            'nilai_akhir' => $request->input('nilai_akhir'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Send WhatsApp notification only if status changed
        if ($oldStatus !== $newStatus) {
            try {
                $student->notify(new StudentStatusUpdated($student, $oldStatus, $newStatus));
                $message = 'Status siswa berhasil diupdate dan notifikasi WhatsApp terkirim.';
            } catch (\Exception $e) {
                \Log::error('Notification failed: ' . $e->getMessage());
                $message = 'Status siswa berhasil diupdate, tetapi notifikasi WhatsApp gagal terkirim.';
            }
        } else {
            $message = 'Data siswa berhasil diupdate.';
        }

        return redirect()->back()->with('success', $message);
    }
}
```

---

## 4. Database untuk Notifikasi (Optional)

Jika ingin menyimpan history notifikasi, buat migration:

```bash
php artisan make:migration create_notifications_table
```

```php
Schema::create('notifications', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('notifiable_type');
    $table->unsignedBigInteger('notifiable_id');
    $table->string('type');
    $table->json('data');
    $table->timestamp('read_at')->nullable();
    $table->timestamps();

    $table->index(['notifiable_type', 'notifiable_id']);
});
```

---

## 5. Testing WhatsApp Notification

### Test dengan Sandbox

Twilio menyediakan sandbox untuk testing:

1. Kirim pesan ke Twilio sandbox number
2. Twilio akan reply dengan join code
3. Setup ready untuk testing

### Test di Aplikasi

```php
// Di controller atau tinker
$student = Student::find(1);
$student->notify(new StudentStatusUpdated($student, 'pending', 'contacted'));
```

### Cek Log

```bash
# Lihat file log
tail -f storage/logs/laravel.log
```

---

## 6. Error Handling

### Common Errors

**Error: "Invalid phone number"**

- Pastikan format nomor benar: +6281234567890
- Remove special characters
- Test dengan nomor yang sudah verified di Twilio

**Error: "Invalid credentials"**

- Check `.env` file
- Verify TWILIO_ACCOUNT_SID dan AUTH_TOKEN
- Copy dari Twilio Dashboard

**Error: "Sandbox mode - message not sent"**

- Gunakan Twilio sandbox mode untuk testing
- Untuk production, upgrade akun ke paid

---

## 7. Cost Estimation

### Twilio Pricing

- **Free tier**: $15 trial credits
- **Per message**: $0.01 - $0.05 (tergantung region)
- **Monthly estimate**: 1000 pesan/bulan ≈ $10-50

### Alternative Services

| Service | Cost           | Setup  | Reliability |
| ------- | -------------- | ------ | ----------- |
| Twilio  | $0.01-0.05/msg | Easy   | Excellent   |
| AWS SNS | $0.0075/msg    | Medium | Excellent   |
| Custom  | Varies         | Hard   | Unknown     |

---

## 8. Security Considerations

✅ **Never hardcode credentials** - Gunakan `.env`
✅ **Use HTTPS** - Pastikan endpoint secure
✅ **Validate phone numbers** - Before sending
✅ **Rate limiting** - Prevent spam
✅ **Log all requests** - For auditing

---

## 9. Implementation Checklist

- [ ] Install Twilio SDK: `composer require twilio/sdk`
- [ ] Setup Twilio account dan dapatkan credentials
- [ ] Add credentials ke `.env`
- [ ] Update `StudentStatusUpdated` notification class
- [ ] Update `AdminStudentController`
- [ ] Test dengan sandbox
- [ ] Test dengan real number
- [ ] Monitor logs untuk errors
- [ ] Setup error alerts/monitoring

---

## 10. Next Steps

1. **Complete Implementation**
    - Implement WhatsApp integration dengan Twilio

2. **Add Features**
    - Notification history in database
    - Retry mechanism untuk failed messages
    - Schedule notifications
    - Bulk messaging

3. **Improve UX**
    - Notification status in admin panel
    - Schedule notifications
    - Template management

4. **Monitoring**
    - Setup error tracking
    - Create dashboard untuk notification stats
    - Alert admin untuk failed messages

---

**Pertanyaan?** Hubungi developer atau check Twilio documentation:

- 📚 https://www.twilio.com/docs/sms/whatsapp/quickstart
- 📧 support@twilio.com

---

_Panduan ini akan diupdate seiring implementasi sistem_
