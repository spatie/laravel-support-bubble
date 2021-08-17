<?php

use Illuminate\Support\Facades\Event;
use Spatie\LaravelSupportForm\Events\SupportFormSubmittedEvent;
use function Pest\Laravel\post;

it('can except a support form submission', function() {
    Event::fake();

    $values = [
        'email' => 'john@example.com',
        'text' => 'My question',
    ];

    post(route('supportForm.submit'), $values)->assertSuccessful();

    Event::assertDispatched(function(SupportFormSubmittedEvent $event) use ($values) {
        expect($event->request->validated())->toEqual($values);

        return true;
    });
});
