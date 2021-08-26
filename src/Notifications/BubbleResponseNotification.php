<?php

namespace Spatie\SupportForm\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\SupportForm\Events\SupportFormSubmittedEvent;

class BubbleResponseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $subject,
        public string $message,
        public string $email,
        public string $name,
    ) {
    }

    public static function fromEvent(SupportFormSubmittedEvent $event): self
    {
        return new self(
            $event->subject,
            $event->message,
            $event->email,
            $event->name,
        );
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject("New bubble message from {$this->name}: {$this->subject}")
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
