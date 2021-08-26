<?php

namespace Spatie\SupportForm\Components;

use Illuminate\Contracts\Auth\Authenticatable;
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
        $this->formAction = route(config('support-form.form_action_route'));
        $this->email = config('support-form.prefill_logged_in_user') ? (optional(request()->user())->email ?? '') : '';
        $this->name = config('support-form.prefill_logged_in_user') ? (optional(request()->user())->name ?? '') : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("support-form::components.support-bubble");
    }
}
