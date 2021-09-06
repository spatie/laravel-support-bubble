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

it('can be rendered', function () {
    $allValues = formValues([
            'ip' => '1.2.3.4',
            'userAgent' => 'my-browser',
        ]);

    $notification = new BubbleResponseNotification(...$allValues);

    $html = (string)$notification->toMail(new AnonymousNotifiable())->render();

    expect($html)->toContain('John Doe (john@example.com) left a new message');
});

it('can render a shorter mail when a name is missing', function () {
    $allValues = formValues([
            'name' => null,
            'ip' => '1.2.3.4',
            'userAgent' => 'my-browser',
        ]);

    $notification = new BubbleResponseNotification(...$allValues);

    $html = (string)$notification->toMail(new AnonymousNotifiable())->render();

    expect($html)->toContain('john@example.com left a new message');
});
