<?php

namespace App\View\Components;
use App\Models\Bank_account;
use App\Models\MyOrder;
use Illuminate\View\Component;

class Bank extends Component
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
//        $accounts = Bank_account::where('admin_show', false)->count();
//        return view('components.bank', compact('accounts'));
////        return view('components.bank');
    }
}
