<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobSeekerOtpNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly string $otpCode)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode OTP Verifikasi Akun JobBoard')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Terima kasih telah mendaftar di JobBoard.')
            ->line('Kode OTP verifikasi akun Anda adalah:')
            ->line('**' . $this->otpCode . '**')
            ->line('Kode ini berlaku selama 5 menit.')
            ->line('Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.')
            ->salutation('JobBoard Recruitment Platform');
    }
}
