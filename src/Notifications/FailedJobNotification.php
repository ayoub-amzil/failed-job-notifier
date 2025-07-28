<?php

namespace AyoubAmzil\FailedJobNotifier\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\Events\JobFailed;

class FailedJobNotification extends Notification
{
    use Queueable;

    protected JobFailed $event;

    public function __construct(JobFailed $event)
    {
        $this->event = $event;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $payload = $this->event->job->payload();

        return (new MailMessage)
            ->subject('🚨 Laravel Job Failed Notification')
            ->line('A queued job has failed in your application.')
            ->line('**Connection:** ' . $this->event->connectionName)
            ->line('**Queue:** ' . $this->event->job->getQueue())
            ->line('**Job Name:** ' . ($payload['displayName'] ?? 'N/A'))
            ->line('**Exception:** ' . $this->event->exception->getMessage())
            ->line('Please check your logs and the job details.');
    }
}
