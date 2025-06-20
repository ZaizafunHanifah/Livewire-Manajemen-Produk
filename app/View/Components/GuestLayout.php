<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Render the layout component.
     */
    public function render(): View
    {
        return view('components.layouts.guest');
    }
}
