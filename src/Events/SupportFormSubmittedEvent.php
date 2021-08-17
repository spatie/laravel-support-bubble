<?php

namespace Spatie\LaravelSupportForm\Events;

use Spatie\LaravelSupportForm\Http\Requests\SupportFormRequest;

class SupportFormSubmittedEvent
{
    public function __construct(public SupportFormRequest $request)
    {
    }
}
