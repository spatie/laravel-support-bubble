<?php

namespace Spatie\SupportBubble\Events;

use Spatie\SupportBubble\Http\Requests\SupportBubbleRequest;

class SupportBubbleSubmittedEvent
{
    public function __construct(
        public string $subject,
        public string $message,
        public string $email,
        public string $name,
    ) {
    }

    public static function fromRequest(SupportBubbleRequest $request): self
    {
        return new static(
            $request->subject,
            $request->message,
            $request->email,
            $request->name,
        );
    }
}
