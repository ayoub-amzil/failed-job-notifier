# Failed Job Notifier

A Laravel package to send email notifications whenever a queued job fails.

## Installation

```bash
composer require ayoub-amzil/failed-job-notifier
```

## Setup

### 1. Publish the configuration file

```bash
php artisan vendor:publish --tag=failed-job-notifier-config
```

### 2. Configure the notification emails

Edit `config/failed-job-notifier.php` and add your notification recipient emails:

```php
return [
    'notify_emails' => [
        'admin@example.com',
    ],
];
```

## Mail Configuration

To receive email notifications on failed jobs, configure your Laravel mail settings in `.env`:

```env
MAIL_MAILER= smtp / log
MAIL_HOST=you_host
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your-email@example.com
MAIL_FROM_NAME="Your App Name"
```

Set mail sending to synchronous for immediate delivery:

```env
MAIL_MAILER=smtp
```

But if you prefer to log emails instead of sending, set:

```env
MAIL_MAILER=log
```

Emails will be saved in `storage/logs/laravel.log` for review. But make sure your queue worker is running if you use queued mail notifications:

```bash
php artisan queue:work
```

This ensures you get timely email notifications when jobs fail.

## How It Works

- Listens to Laravel's `JobFailed` event.
- Sends an email notification with details about the failed job.
- Uses Laravel’s built-in failed job handling for storage (no duplication).

## Compatibility

- Laravel 10, 11, 12+
- PHP 8.1+

## License

MIT License
