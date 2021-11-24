<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReportController extends Controller
{
    public function index()
    {
        $update = DB::table('user_reports')->where("show", false)->update(['show' => true]);

        $reports = UserReport::orderBy('id', 'DESC')->get();
        return view('user.userreports', compact('reports'));
    }
    public function view_user_report(Request $request)
    {
        $id = $request->id;
        $user = UserReport::with('fromUser', 'toUser', 'reportCategory')->where('id', $id)->first();
        $report_time = Carbon::parse($user->created_at)->format('d/m/y');
        return response()->json(['success' => true, 'user' => $user, 'report_time' => $report_time]);
    }
    public function delete_user_report(Request $request)
    {
        $id = $request->id;
        UserReport::find($id)->delete();
        return response()->json(['success' => true]);
    }
    public function done_user_report(Request $request)
    {
        $id = $request->id;
        $user = UserReport::find($id);
        $user->done = true;
        $user->save();
        return response()->json(['success' => true]);
    }
}
