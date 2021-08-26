<?php

namespace Spatie\SupportBubble\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SupportBubble extends Component
{
    public string $formAction;

    public string $email;

    public string $name;

    public function __construct()
    {
        $this->formAction = route(config('support-bubble.form_action_route'));
        $this->email = config('support-bubble.prefill_logged_in_user') ? (optional(request()->user())->email ?? '') : '';
        $this->name = config('support-bubble.prefill_logged_in_user') ? (optional(request()->user())->name ?? '') : '';
    }

    public function render(): View
    {
        return view("support-bubble::components.support-bubble");
    }

    public function hasField(string $field): bool
    {
        return config("support-bubble.fields.{$field}", false);
    }
}
