<?php

namespace App\View\Components\Classrooms;

use Illuminate\View\Component;

class AddClass extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $grades;

    public function __construct($grades)
    {
        $this->grades = $grades;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.classrooms.add-class');
    }
}
