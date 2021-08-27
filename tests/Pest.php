<?php

use Illuminate\Foundation\Auth\User;
use Spatie\SupportBubble\SupportBubbleServiceProvider;
use Spatie\SupportBubble\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function logIn(): void
{
    auth()->login((new User())->forceFill([
        'email' => 'john@example.com',
        'name' => 'John Doe',
    ]));
}

function formValues(): array
{
    return [
        'name' => 'John Doe',
        'subject' => 'Subject',
        'email' => 'john@example.com',
        'message' => 'My question',
        'url' => 'https://example.com',
    ];
}

function refreshServiceProvider()
{
    (new SupportBubbleServiceProvider(app()))->packageBooted();
}
