<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class StudentStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Student $student, public string $oldStatus, public string $newStatus)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Return array of notification channels
        // When implemented, will support: ['whatsapp', 'database']
        return [];
    }

    /**
     * Get the WhatsApp representation of the notification.
     * 
     * NOTE: This requires implementation of WhatsApp notification channel
     * Options:
     * 1. Twilio WhatsApp API
     * 2. AWS SNS
     * 3. Custom WhatsApp Business API integration
     */
    public function toWhatsApp(object $notifiable): array
    {
        $messages = [
            'pending' => [
                'title' => 'Pendaftaran Diterima',
                'message' => "Halo {$this->student->nama}!\n\nPendaftaran Anda telah diterima. Kami akan memverifikasi data Anda dan menghubungi dalam waktu singkat.\n\nTerima kasih.",
            ],
            'contacted' => [
                'title' => 'Admin Akan Menghubungi',
                'message' => "Halo {$this->student->nama}!\n\nAdmin sekolah akan segera menghubungimu untuk verifikasi data pendaftaran.\n\nSilakan pastikan nomor HP ini aktif.\n\nTerima kasih.",
            ],
            'verified' => [
                'title' => 'Selamat! Anda Lulus',
                'message' => "🎉 Selamat {$this->student->nama}!\n\nKamu dinyatakan LULUS!\n\nSilakan login ke portal siswa untuk download sertifikat kelulusan.\n\nURL: https://sekolah.sch.id/student/graduation-status",
            ],
            'rejected' => [
                'title' => 'Pemberitahuan Penting',
                'message' => "Pemberitahuan untuk {$this->student->nama}\n\nMohon maaf, kamu belum dinyatakan lulus berdasarkan hasil evaluasi.\n\nSilakan hubungi sekolah untuk informasi lebih lanjut.\n\nKontak: admin@sekolah.sch.id",
            ],
        ];

        $message = $messages[$this->newStatus] ?? null;

        if (!$message) {
            return [];
        }

        // Return WhatsApp message format
        return [
            'phone' => $this->formatPhoneNumber($this->student->hp),
            'title' => $message['title'],
            'message' => $message['message'],
        ];
    }

    /**
     * Format phone number for WhatsApp API
     * Converts: 081234567890 → +6281234567890
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Remove non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If starts with 0, replace with country code
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Add + prefix
        return '+' . $phone;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'student_id' => $this->student->id_siswa,
            'student_name' => $this->student->nama,
            'status_changed_from' => $this->oldStatus,
            'status_changed_to' => $this->newStatus,
            'message' => "Status {$this->student->nama} diubah dari {$this->oldStatus} menjadi {$this->newStatus}",
        ];
    }
}
