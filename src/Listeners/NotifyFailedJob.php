<?php

namespace AyoubAmzil\FailedJobNotifier\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Notification;
use AyoubAmzil\FailedJobNotifier\Notifications\FailedJobNotification;

class NotifyFailedJob
{
    public function handle(JobFailed $event): void
    {
        $emails = config('failed-job-notifier.notify_emails', []);

        if (empty($emails)) {
            return; // No emails configured, skip notification
        }

        Notification::route('mail', $emails)
            ->notify(new FailedJobNotification($event));
    }
}
