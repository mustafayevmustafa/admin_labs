<?php

namespace App\View\Components;

use App\Models\UserReport;
use Illuminate\View\Component;

class ReportUser extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        $users = UserReport::where('show', false)->count();
        return view('components.report-user', compact('users'));
    }
}
