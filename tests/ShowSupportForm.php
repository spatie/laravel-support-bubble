<?php

use Spatie\LaravelSupportForm\Http\Middleware\ShowSupportForm;
use function Pest\Laravel\get;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('will add the support form to a response', function() {
    Route::get('/', function() {
        return '<html><body></body></html>';
    })->middleware(ShowSupportForm::class);

    $html = (string)get('/')->assertSuccessful()->getContent();

    assertMatchesSnapshot($html);
});
