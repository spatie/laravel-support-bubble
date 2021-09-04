<?php

namespace Spatie\SupportBubble\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

class BubbleResponseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $subject,
        public string $message,
        public string $email,
        public string $name,
        public string | null $url,
        public string | null $ip,
        public string | null $userAgent,
    ) {
    }

    public static function fromEvent(SupportBubbleSubmittedEvent $event): self
    {
        return new self(
            $event->subject ?? 'Support bubble message',
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

        return (new MailMessage())
            ->subject("Support bubble message from {$this->name}: {$this->subject}")
            ->replyTo($this->email)
            ->greeting($this->subject)
            ->line("{$this->who()} left a new message using the chat bubble:")
            ->line(new HtmlString("<blockquote>{$this->message}</blockquote>"))
            ->line($metadataHtml);
    }

    protected function getMetadataHtml(): HtmlString
    {
        $html = <<<HTML
        <h3>Meta</h3>
            <ul>
              <li><strong>Name</strong>: {$this->name}</li>
              <li><strong>E-mail</strong>: {$this->email}</li>
              <li><strong>Subject</strong>: {$this->subject}</li>
              <li><strong>URL</strong>: {$this->url}</li>
              <li><strong>IP-address</strong>: {$this->ip}</li>
              <li><strong>User-agent</strong>: {$this->userAgent}</li>
            </ul>
        HTML;

        return new HtmlString(trim($html));
    }
    

    protected function who(): string
    {
        if ($this->name == null) {
            return $this->email;
        } 

        return $this->name . "(" . $this->email . ")";
    }
}
