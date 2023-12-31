<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusSupport extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct( protected string $status){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $statusSupport = $this->status;
        $color ='gray';
        $color = $statusSupport === 'Active' ? 'green' : $color;
        $color = $statusSupport === 'Pendent' ? 'red' : $color;

        $status = getStatusSupport($statusSupport);
        return view('components.status-support', compact('status', 'color'));
    }
}
