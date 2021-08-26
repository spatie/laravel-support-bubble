<?php

use Illuminate\Support\Facades\Event;
use function Pest\Laravel\post;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;

beforeEach(function () {
    $this->formValues = [
        'name' => 'John Doe',
        'subject' => 'Subject',
        'email' => 'john@example.com',
        'message' => 'My question',
    ];

    Event::fake();
});

it('can accept a support form submission', function () {
    post(route('supportBubble.submit'), $this->formValues)->assertSuccessful();

    Event::assertDispatched(function (SupportBubbleSubmittedEvent $event) {
        expect($event->request->validated())->toEqual($this->formValues);

        expect($event->request)
            ->name->toEqual($this->formValues['name'])
            ->subject->toEqual($this->formValues['subject'])
            ->email->toEqual($this->formValues['email'])
            ->message->toEqual($this->formValues['message']);

        return true;
    });
});

it('will validate all fields by default', function (string $name) {
    unset($this->formValues[$name]);

    post(route('supportBubble.submit'), $this->formValues)->assertInvalid([$name]);
})->with('formFields');

it('can disable validation for a field', function (string $name) {
    unset($this->formValues[$name]);

    config()->set("support-bubble.fields.{$name}", false);

    post(route('supportBubble.submit'), $this->formValues)->assertValid();

    Event::assertDispatched(SupportBubbleSubmittedEvent::class);
})->with('formFields');



dataset('formFields', [
    'name',
    'subject',
    'email',
    'message',
]);
