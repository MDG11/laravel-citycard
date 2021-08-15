<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Transaction::where('status','=','pending')->where('type','=','withdraw')->get();
        return view('admin.withdraws.index', compact('withdraws'));
    }
    public function approve(Transaction $withdraw)
    {
        $withdraw->update([
            'status' => 'succeded'
        ]);
        return back()->with('success', 'Approved');
    }
    public function decline(Transaction $withdraw)
    {
        $withdraw->update([
            'status' => 'failed'
        ]);
        return back()->with('success', 'Declined');
    }
}
