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
        public string $email,
        public string $name,
        public string|null $url,
        public string|null $ip,
        public string|null $userAgent,
    ) {
    }

    public static function fromEvent(SupportBubbleSubmittedEvent $event): self
    {
        return new self(
            $event->subject ?? 'No subject',
            $event->message ?? 'No message',
            $event->email ?? config('support-bubble.mail_to') ?? 'No email',
            $event->name ?? 'Unknown',
            $event->url ?? 'Unknown',
            $event->ip ?? 'Unknown',
            $event->userAgent ?? 'Unknown',
        );
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $metadataHtml = $this->getMetadataHtml();

        if (config('support-bubble.impersonate_mail_from_user')) {
            return (new MailMessage())
                ->from($this->email, $this->name)
                ->subject($this->subject ?? 'No subject')
                ->line($metadataHtml)
                ->line($this->message ?? 'No message');
        }

        return (new MailMessage())
            ->subject("New support bubble message from {$this->name}: {$this->subject}")
            ->greeting("\"{$this->subject}\"")
            ->line($metadataHtml)
            ->line("{$this->name} ({$this->email}) left a new message using the chat bubble:")
            ->line("<blockquote>{$this->message}</blockquote>");
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }

    protected function getMetadataHtml(): string
    {
        return <<<HTML
            <dl>
              <dt>Name</dt><dd>{$this->name}</dd>
              <dt>E-mail</dt><dd>{$this->email}</dd>
              <dt>Subject</dt><dd>{$this->subject}</dd>
              <dt>URL</dt><dd>{$this->url}</dd>
              <dt>IP address</dt><dd>{$this->ip}</dd>
              <dt>User-agent</dt><dd>{$this->userAgent}</dd>
            </dl>
        HTML;
    }
}
