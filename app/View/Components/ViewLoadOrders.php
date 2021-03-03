<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
Use Illuminate\Pagination\LengthAwarePaginator;

class ViewLoadOrders extends Component
{

    /**
     * The load orders.
     *
     * @var Collection
     */
    public $loadOrders;

    /**
     * Create a new component instance.
     * @var Collection $loadOrders
     * @return void
     */
    public function __construct(LengthAwarePaginator $loadOrders)
    {
        $this->loadOrders = $loadOrders;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.view-load-orders');
    }
}
