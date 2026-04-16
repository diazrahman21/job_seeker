<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobSeekerSuspendedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private string $reason = 'Akun Anda telah ditangguhkan.')
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'message' => 'Akun Anda telah ditangguhkan sementara waktu.',
            'reason' => $this->reason,
        ]);
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Akun Ditangguhkan')
            ->greeting('Halo!')
            ->line('Kami ingin memberitahu bahwa akun Anda telah ditangguhkan.')
            ->line('Alasan: ' . $this->reason)
            ->line('Jika Anda merasa ini adalah kesalahan, silakan hubungi dukungan kami.')
            ->action('Hubungi Dukungan', url('/'))
            ->line('Terima kasih.');
    }
}
