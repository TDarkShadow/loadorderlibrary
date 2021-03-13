<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditLoadOrder extends Component
{

	/**
	 * The load orders.
	 *
	 * @var Collection
	 */
	public $loadOrder;

	/**
	 * Create a new component instance.
	 * @var Collection $loadOrder
	 * @return void
	 */
	public function __construct($loadOrder)
	{
		$this->loadOrder = $loadOrder;
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.edit-load-order');
    }
}
