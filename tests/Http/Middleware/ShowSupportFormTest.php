<?php

use function Pest\Laravel\get;
use Spatie\LaravelSupportForm\Http\Middleware\ShowSupportForm;

it('will add the support form to a response', function () {
    Route::get('/', function () {
        return '<html><body></body></html>';
    })->middleware(ShowSupportForm::class);

    get('/')->assertSuccessful()->assertSee('support-form');
});

it('will not add the support form to a response this does not look like html', function () {
    Route::get('/', function () {
        return json_encode(['i am not HTML']);
    })->middleware(ShowSupportForm::class);

    get('/')->assertSuccessful()->assertDontSee('support-form');
});
