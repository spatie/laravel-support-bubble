<?php

namespace Spatie\SupportBubble\Components;

use Illuminate\View\Component;
use Str;

class SupportBubble extends Component
{
    public string $positionY;

    public string $positionX;

    public string $formAction;

    public string $email;

    public string $name;

    public function __construct(string $position)
    {
        $this->positionY = Str::contains($position, 'top') ? 'top' : 'bottom';
        $this->positionX = Str::contains($position, 'left') ? 'left' : 'right';
        $this->formAction = route(config('support-bubble.form_action_route'));
        $this->email = config('support-bubble.prefill_logged_in_user') ? (optional(request()->user())->email ?? '') : '';
        $this->name = config('support-bubble.prefill_logged_in_user') ? (optional(request()->user())->name ?? '') : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("support-bubble::components.support-bubble");
    }
}
