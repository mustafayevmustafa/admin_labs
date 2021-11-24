<?php

namespace App\Http\Controllers;


use App\Models\Bank;
use App\Models\Bank_account;
use App\Models\MyOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function  index()
    {

        $accounts = Bank_account::select(
            'bank_accounts.id',
            'bank_accounts.account_holder_name',
            'bank_accounts.address',
            'bank_accounts.account_holder_type',
            'bank_accounts.bank_account_type',
            'bank_accounts.bank_account_currency',
            'bank_accounts.IBAN',
            'bank_accounts.bank_swift_number',
            'bank_accounts.bank_territory',
            'bank_accounts.bank_code',
            'bank_accounts.bank_account_number',
            'bank_accounts.status',
            DB::raw("(SELECT username FROM users WHERE  bank_accounts.user_id = users.id) as name")

//            DB::raw("(SELECT CONCAT(first_name , ' ' , last_name) FROM users WHERE  bank_accounts.user_id = users.id) as name")
        )
            ->orderBy("bank_accounts.created_at", "DESC")
            ->get();

        return view('bank.bank_account', compact('accounts'));
    }


    public function changeStatus(Request  $request){
           $change=Bank_account::find($request->id);
           $change->status= $request->status;
           if(isset($request->not))
           {
               $change->not = $request->not;
           }
           $change->save();
           return response()->json(["message" => "successful"]);

     }

    public function show_account($id)
    {
        $account = Bank_account::findOrFail($id);


        return view('bank.bank_show',compact('account'));
    }
}
