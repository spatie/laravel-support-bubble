<?php

use Spatie\LaravelSupportForm\Http\Middleware\ShowSupportForm;
use function Pest\Laravel\get;

it('will add the support form to a response', function() {
    Route::get('/', function() {
        return '<html><body></body></html>';
    })->middleware(ShowSupportForm::class);

    get('/')->assertSuccessful()
        ->assertSee('support-form-button')
        ->assertSee('support-form-form');

});
