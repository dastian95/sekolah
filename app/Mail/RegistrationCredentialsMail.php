<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $studentName;
    public string $registrationNumber;
    public string $username;
    public string $plainPassword;
    public string $schoolName;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $studentName,
        string $registrationNumber,
        string $username,
        string $plainPassword
    ) {
        $this->studentName = $studentName;
        $this->registrationNumber = $registrationNumber;
        $this->username = $username;
        $this->plainPassword = $plainPassword;
        $this->schoolName = config('app.name', 'SDIT Labitech Insan Mulia');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi Akun Pendaftaran - ' . $this->schoolName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-credentials',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
