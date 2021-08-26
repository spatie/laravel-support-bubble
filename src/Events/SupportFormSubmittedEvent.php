<?php

namespace Spatie\SupportForm\Events;

use Spatie\SupportForm\Http\Requests\SupportFormRequest;

class SupportFormSubmittedEvent
{
    public function __construct(
        public string $subject,
        public string $message,
        public string $email,
        public string $name,
    ) {
    }

    public static function fromRequest(SupportFormRequest $request): self
    {
        return new static(
            $request->subject,
            $request->message,
            $request->email,
            $request->name,
        );
    }
}
