<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class UserUploadForm extends Component
{

    /**
     * The games to choose from.
     *
     * @var Collection
     */
    public $games;

    /**
     * Create a new component instance.
     * @var Collection $games
     * @return void
     */
    public function __construct(Collection $games)
    {
        $this->games = $games;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.user-upload-form');
    }
}
