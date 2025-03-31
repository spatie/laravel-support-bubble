<?php

namespace Spatie\SupportBubble\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Spatie\SupportBubble\Dtos\Attachment;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

class BubbleResponseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $subject,
        public string $message,
        public string $email,
        public string | null $name,
        public string | null $url,
        public string | null $ip,
        public string | null $userAgent,
        public string | null $attachmentKey,
        public string | null $attachmentName,
    ) {
    }

    public static function fromEvent(SupportBubbleSubmittedEvent $event): self
    {
        return new self(
            $event->subject ?? '',
            $event->message ?? 'No message',
            $event->email ?? config('support-bubble.mail_to') ?? 'No email',
            $event->name,
            $event->url ?? 'Unknown',
            $event->ip ?? 'Unknown',
            $event->userAgent ?? 'Unknown',
            $event->attachmentKey,
            $event->attachmentName,
        );
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $metadataHtml = $this->getMetadataHtml();

        $message = nl2br($this->message);

        return (new MailMessage())
            ->mailer(config('support-bubble.mailer') ?? config('mail.default'))
            ->from(config('support-bubble.mail_from') ?? config('mail.from.address'))
            ->subject("Support bubble message from {$this->name}" . ($this->subject ? ": {$this->subject}" : ''))
            ->replyTo($this->email)
            ->greeting($this->subject)
            ->line("{$this->submitter()} left a new message using the chat bubble:")
            ->line(new HtmlString("<br/><blockquote>{$message}</blockquote><br/>"))
            ->line($metadataHtml)
            ->when($this->attachmentKey, function (MailMessage $message) {
                $message->attach(
                    Storage::disk($this->getDisk())->path($this->attachmentKey),
                    [
                        'as' => $this->attachmentName,
                    ]);
            });
    }

    protected function getMetadataHtml(): HtmlString
    {
        $html = view('support-bubble::mail.meta', [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'url' => $this->url,
            'ip' => $this->ip,
            'userAgent' => $this->userAgent,
        ])->render();

        return new HtmlString(trim($html));
    }

    protected function submitter(): string
    {
        return is_null($this->name)
            ? $this->email
            : "{$this->name} ({$this->email})";
    }

    protected function getDisk(): string
    {
        if (config('support-bubble.attachment_disk')) {
            return config('support-bubble.attachment_disk');
        }

        return config('filesystems.default');
    }
}
