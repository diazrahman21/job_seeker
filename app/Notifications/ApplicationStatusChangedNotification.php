<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusChangedNotification extends Notification
{
    use Queueable;

    public function __construct(public Application $application)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Update status lamaran Anda')
            ->line('Status lamaran untuk posisi ' . $this->application->job->title . ' berubah menjadi: ' . strtoupper($this->application->status))
            ->line($this->application->status_note ?: 'Tidak ada catatan tambahan.')
            ->action('Lihat dashboard', route('job-seeker.dashboard'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->application->job_id,
            'job_title' => $this->application->job->title,
            'status' => $this->application->status,
            'note' => $this->application->status_note,
        ];
    }
}
