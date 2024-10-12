<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployerComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public object $employer)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employer-component');
    }
}
