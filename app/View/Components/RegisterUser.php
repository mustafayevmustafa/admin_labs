<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class RegisterUser extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $users;
    public function __construct()
    {
        $this->users = User::where('submit', 0)->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.register-user');
    }
}
