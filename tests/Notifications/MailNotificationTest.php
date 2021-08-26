<?php

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\post;
use Spatie\SupportBubble\Notifications\BubbleResponseNotification;

beforeEach(function () {
    $this->formValues = formValues();
});

it('will not send a mail notification by default', function () {
    Notification::fake();

    post(route('supportBubble.submit'), $this->formValues)->assertSuccessful();

    Notification::assertNothingSent();
});

it('can be configured to send a notification', function () {
    config()->set('support-bubble.mail_to', 'jane@example.com');
    refreshServiceProvider();

    Notification::fake();

    post(route('supportBubble.submit'), $this->formValues)->assertSuccessful();

    Notification::assertSentTo(new AnonymousNotifiable(), function (BubbleResponseNotification $notification) {
        expect($notification)
            ->name->toEqual($this->formValues['name'])
            ->subject->toEqual($this->formValues['subject'])
            ->email->toEqual($this->formValues['email'])
            ->message->toEqual($this->formValues['message']);

        return true;
    });
});
