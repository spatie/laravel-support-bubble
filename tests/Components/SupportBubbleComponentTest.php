<?php

it('can be rendered')
    ->blade('<x-support-bubble />')
    ->assertSee('spatie-support-bubble');
