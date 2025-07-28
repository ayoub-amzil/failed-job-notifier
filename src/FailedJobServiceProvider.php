<?php

namespace AyoubAmzil\FailedJobNotifier;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobFailed;
use AyoubAmzil\FailedJobNotifier\Listeners\NotifyFailedJob;

class FailedJobServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/failed-job-notifier.php', 'failed-job-notifier');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/failed-job-notifier.php' => config_path('failed-job-notifier.php'),
            ], 'failed-job-notifier-config');
        }

        Event::listen(JobFailed::class, NotifyFailedJob::class);
    }
}
