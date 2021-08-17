<?php

namespace Spatie\SupportForm\Events;

use Spatie\SupportForm\Http\Requests\SupportFormRequest;

class SupportFormSubmittedEvent
{
    public function __construct(public SupportFormRequest $request)
    {}
}
