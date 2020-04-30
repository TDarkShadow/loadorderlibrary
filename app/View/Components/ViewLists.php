<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ViewLists extends Component
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
    public function __construct(Collection $loadOrders)
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
        return view('components.user-welcome');
    }
}
