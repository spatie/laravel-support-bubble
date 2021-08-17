<?php

namespace Spatie\SupportForm\Http\Controllers;

use Spatie\SupportForm\Events\SupportFormSubmittedEvent;
use Spatie\SupportForm\Http\Requests\SupportFormRequest;

class HandleSupportFormSubmissionController
{
    public function __invoke(SupportFormRequest $request)
    {
        event(new SupportFormSubmittedEvent($request));

        return view('support-form::success');
    }
}
