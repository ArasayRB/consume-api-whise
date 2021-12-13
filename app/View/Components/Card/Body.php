<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class Body extends Component
{
    /**
     * The property status.
     *
     * @var string
     */
    public $status;

    /**
     * The property status.
     *
     * @var array
     */
    public $estate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status,$estate)
    {
        $this->status=$status;
        $this->estate=$estate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card.body');
    }
}
