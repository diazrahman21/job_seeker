<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Job $job)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'message' => "Lowongan '{$this->job->title}' telah disetujui.",
        ]);
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Lowongan Disetujui')
            ->line("Lowongan kerja '{$this->job->title}' telah disetujui oleh admin.")
            ->line('Lowongan Anda sekarang dapat dilihat oleh para pencari kerja.')
            ->action('Lihat Lowongan', url("/recruiter/jobs/{$this->job->id}"))
            ->line('Terima kasih telah menggunakan Job Board kami.');
    }
}
