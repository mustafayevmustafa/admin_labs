<?php

namespace App\Http\Controllers;

use App\Models\MyOrder;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\True_;

class OrderController extends Controller
{
    public function index()
    {
        MyOrder::leftJoin('projects', 'projects.id', '=', 'my_orders.project_id')->update([
            'admin_show' => true
        ]);

        $orders = MyOrder::select(
            'my_orders.id',
            'name',
            'submit_order',
            'slug',
            'username',
            'my_orders.created_at',
            'projects.user_id',
            'my_orders.price'
        )->leftJoin('projects', 'projects.id', '=', 'my_orders.project_id')
            ->leftJoin('users', 'users.id', '=', 'my_orders.user_id')
            ->orderBy("my_orders.created_at", "DESC")
            ->get();
        return view('order.orders', compact('orders'));
    }
    public function send_order(Request $request)
    {
        $id = $request->id;
        $myOrder = MyOrder::find($id);

        if ($myOrder) {

            $user = $myOrder->user_id;
            $price = $myOrder->price;

            $project = Project::find($myOrder->project_id);
            $sales = $project->sales;
            $project->sales = $sales + 1;
            $project->save();
            $user_id = $project->user_id;
            $user = User::find($user_id);
            $user_money = $user->money;
            $user->money = $user_money + $price;
            $user->save();
            $myOrder->submit_order = true;
            $myOrder->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
