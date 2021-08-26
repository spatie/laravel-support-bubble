<?php

namespace Spatie\SupportBubble\Events;

use Spatie\SupportBubble\Http\Requests\SupportBubbleRequest;

class SupportBubbleSubmittedEvent
{
    public function __construct(
        public string | null $subject,
        public string | null $message,
        public string | null $email,
        public string | null $name,
        public SupportBubbleRequest $request
    ) {
    }

    public static function fromRequest(SupportBubbleRequest $request): self
    {
        return new static(
            $request->get('subject'),
            $request->get('message'),
            $request->get('email'),
            $request->get('name'),
            $request,
        );
    }
}
