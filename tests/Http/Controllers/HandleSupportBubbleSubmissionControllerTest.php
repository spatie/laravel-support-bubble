<?php

use Illuminate\Support\Facades\Event;
use function Pest\Laravel\post;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

it('can except a support form submission', function () {
    Event::fake();

    $values = [
        'name' => 'John Doe',
        'subject' => 'Subject',
        'email' => 'john@example.com',
        'message' => 'My question',
    ];

    post(route('supportBubble.submit'), $values)->assertSuccessful();


    Event::assertDispatched(function (SupportBubbleSubmittedEvent $event) use ($values) {
        expect($event->request->validated())->toEqual($values);

        expect($event->request)
            ->name->toEqual($values['name'])
            ->subject->toEqual($values['subject'])
            ->email->toEqual($values['email'])
            ->message->toEqual($values['message']);

        return true;
    });
});
