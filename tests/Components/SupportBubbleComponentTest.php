<?php


it('can be rendered')
    ->blade('<x-support-bubble />')
    ->assertSee('spatie-support-bubble');

it('can automatically use the logged in user', function () {
    logIn();

    test()->blade('<x-support-bubble />')
        ->assertSee('john@example.com')
        ->assertSee('John Doe');
});

it('can be configured not to use the logged in user', function () {
    logIn();

    config()->set('support-bubble.prefill_logged_in_user', false);

    test()->blade('<x-support-bubble />')
        ->assertDontSee('john@example.com')
        ->assertDontSee('John Doe');
});

it('can render the submit button using the default translation string')
    ->blade('<x-support-bubble />')
    ->assertSee('Submit');
