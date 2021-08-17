<?php

namespace Spatie\LaravelSupportForm\Http\Controllers;

use Spatie\LaravelSupportForm\Events\SupportFormSubmittedEvent;
use Spatie\LaravelSupportForm\Http\Requests\SupportFormRequest;

class HandleSupportFormSubmissionController
{
    public function __invoke(SupportFormRequest $request)
    {
        event(new SupportFormSubmittedEvent($request));

        return view('support-form::success');
    }
}
