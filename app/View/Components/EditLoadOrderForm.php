<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditLoadOrderForm extends Component
{

	/**
	 * The load orders.
	 *
	 * @var Collection
	 */
	public $loadOrder;

	public $games;

	/**
	 * Create a new component instance.
	 * @var Collection $loadOrder
	 * @return void
	 */
	public function __construct($loadOrder, $games)
	{
		$this->loadOrder = $loadOrder;
		$this->games = $games;
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.edit-load-order-form');
    }
}
