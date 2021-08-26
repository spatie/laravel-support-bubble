<?php

namespace Spatie\SupportBubble\Http\Controllers;

use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;
use Spatie\SupportBubble\Http\Requests\SupportBubbleRequest;

class HandleSupportBubbleSubmissionController
{
    public function __invoke(SupportBubbleRequest $request)
    {
        event(SupportBubbleSubmittedEvent::fromRequest($request));

        return view('support-bubble::success');
    }
}
