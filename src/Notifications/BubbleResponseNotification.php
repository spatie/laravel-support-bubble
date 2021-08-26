<?php

namespace Spatie\SupportBubble\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

class BubbleResponseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $subject,
        public string $message,
        public string | null $email,
        public string $name,
    ) {
    }

    public static function fromEvent(SupportBubbleSubmittedEvent $event): self
    {
        return new self(
            $event->subject ?? 'No subject',
            $event->message ?? 'No message',
            $event->email ?? config('support-bubble.mail_to') ?? 'No email',
            $event->name ?? 'Unknown',
        );
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        if (config('support-bubble.impersonate_mail_from_user')) {
            return (new MailMessage())
                ->from($this->email, $this->name)
                ->subject($this->subject ?? 'No subject')
                ->line($this->message ?? 'No message');
        }

        return (new MailMessage())
            ->subject("New support bubble message from {$this->name}: {$this->subject}")
            ->greeting("\"{$this->subject}\"")
            ->line("{$this->name} ({$this->email}) left a new message using the chat bubble:")
            ->line("<blockquote>{$this->message}</blockquote>");
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
