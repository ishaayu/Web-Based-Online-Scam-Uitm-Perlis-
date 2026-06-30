<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CaseSolvedNotification extends Notification
{
    use Queueable;

    public $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $caseName = $this->report->scam_type ?? $this->report->title ?? 'Security Incident';

        return (new MailMessage)
            ->subject('Polis Bantuan UiTM: Incident Resolution Profile - Case #' . $this->report->id)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Good news! Your security report regarding a ' . $caseName . ' has been comprehensively resolved by the UiTM Perlis Auxiliary Police Team.')
            ->line('**Case Reference ID:** #' . $this->report->id)
            ->line('**Status:** Solved ✅')
            ->action('Download Summary Report', route('report.summary', $this->report->id))
            ->line('Thank you for assisting us.');
    }

    public function toArray($notifiable): array
    {
        return [
            'report_id' => $this->report->id,
            'message' => 'Your security incident file #' . $this->report->id . ' has been successfully resolved.',
        ];
    }
}