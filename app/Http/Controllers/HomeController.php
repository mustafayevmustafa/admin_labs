<?php

namespace App\Http\Controllers;

use App\Models\MyOrder;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where("is_admin", false)->get();
        $projects = Project::select('id')->get();
        $myOrders = MyOrder::all();
        return view('home', compact('users', 'projects', 'myOrders'));
    }
}
