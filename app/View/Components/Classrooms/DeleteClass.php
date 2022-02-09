<?php

namespace App\View\Components\Classrooms;

use Illuminate\View\Component;

class DeleteClass extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $classroom;
    public function __construct($classroom)
    {
        $this->classroom = $classroom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.classrooms.delete-class');
    }
}
