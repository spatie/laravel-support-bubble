<?php

namespace Spatie\SupportForm\Components;

use Illuminate\View\Component;
use Str;

class SupportBubble extends Component
{
    public string $positionY;

    public string $positionX;

    public string $formAction;

    public function __construct(string $position)
    {
        $this->positionY = Str::contains($position, 'top') ? 'top' : 'bottom';
        $this->positionX = Str::contains($position, 'left') ? 'left' : 'right';
        $this->formAction = route(config('support-form.form_action_route'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $style = config('support-form.template_styling', 'css');

        return view("support-form::styles.{$style}.support-bubble");
    }
}
