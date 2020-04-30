<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use \Illuminate\View\View;

class ViewLoadOrder extends Component
{

    /**
     * The load orders.
     *
     * @var Collection
     */
	public $loadOrder;

	
	public $files;

    /**
     * Create a new component instance.
     * @var Collection $loadOrder
	 * @var array $files
     * @return void
     */
    public function __construct($loadOrder, $files)
    {
		$this->loadOrder = $loadOrder;
		$this->files     = $files;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('components.view-load-order');
    }
}
