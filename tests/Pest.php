<?php

use Illuminate\Foundation\Auth\User;
use Spatie\SupportBubble\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function logIn()
{
    auth()->login((new User())->forceFill([
        'email' => 'john@example.com',
        'name' => 'John Doe',
    ]));
}
