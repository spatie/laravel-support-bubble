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

    public function __construct(string $position)
    {
        $this->positionY = Str::contains($position, 'top') ? 'top' : 'bottom';
        $this->positionX = Str::contains($position, 'left') ? 'left' : 'right';
        $this->formAction = route(config('support-form.form_action_route'));
        $this->email = config('support-form.prefill_email_from_request') ? (optional(request()->user())->email ?? '') : '';
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
