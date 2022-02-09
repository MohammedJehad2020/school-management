<?php

namespace App\View\Components\GradesModals;

use Illuminate\View\Component;

class DeleteGrade extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $grade;
    public function __construct($grade)
    {
        $this->grade = $grade;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.GradesModals.delete-grade');
    }
}
