<?php

use Illuminate\Support\Facades\Event;
use function Pest\Laravel\post;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

it('can except a support form submission', function () {
    Event::fake();

    $values = [
        'email' => 'john@example.com',
        'text' => 'My question',
    ];

    post(route('SupportBubble.submit'), $values)->assertSuccessful();

    Event::assertDispatched(function (SupportBubbleSubmittedEvent $event) use ($values) {
        expect($event->request->validated())->toEqual($values);

        return true;
    });
});
