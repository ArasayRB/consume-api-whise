<?php

namespace App\View\Components\Table\Header;

use Illuminate\View\Component;

class HeaderMenuLeftSelect extends Component
{
    /**
     * The property status.
     *
     * @var string
     */
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected)
    {
        $this->selected=$selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.header.header-menu-left-select');
    }
}
