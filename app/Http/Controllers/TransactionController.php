<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function refill_balance_show()
    {

        return view('transactions.refill_form');
    }

    public function proceed_refill(Request $request)
    {

        $request->validate([
            "sum" => 'required',
            "name" => "required",
            "number" => "required|numeric",
            "month" => "required|numeric",
            "year" => "required|numeric",
            "cvv" => "required|numeric",
        ]);
        $stripe = Stripe::make(env('STRIPE_SECRET'));

        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    "name" => $request->name,
                    "number" => $request->number,
                    "exp_month" => $request->month,
                    "exp_year" => $request->year,
                    "cvc" => $request->cvv,
                ]
            ]);

            if (!isset($token['id'])) {
                redirect()->back()->with('stripe_error', 'The stripe token was not generated correctly!');
            }

            $customer = $stripe->customers()->create([
                'phone' => $request->phone,
                'source' => $token['id']
            ]);
            $sum = explode('.', $request->sum);
            $sum = $sum[0] . $sum[1];
            $sum = floatval(str_replace('.', '', $request->sum)); // convert cart total to comparable float 
            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'USD',
                'amount' => $sum / 100,
                'description' => 'Citycard refill',
            ]);
            if ($charge['status'] == 'succeeded') {
                $transaction = new Transaction();
                $transaction->card_id = auth()->user()->id;
                $transaction->card_number = $request->number;
                $transaction->status = 'succeeded';
                $transaction->sum = $sum;
                $transaction->type = 'refill';
                $transaction->save();
                $user = auth()->user();
                $user->balance += $sum;
                $user->save();
                return redirect(route('home'));
            } else {
                return redirect()->back()->with('stripe_error', 'Payment didn`t succedd?)');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('stripe_error', $e->getMessage());
        }
    }
    public function balance_withdraw_show()
    {
        return view('transactions.withdraw_form');
    }
    public function balance_withdraw(Request $request)
    {
        $request->validate([
            "sum" => 'required',
            "number" => "required|numeric",
        ]);
        $sum = intval(str_replace('.', '', $request->sum)); // convert cart total to comparable float 
        if ($sum > auth()->user()->balance) return redirect()->back()->with('success', 'Not enough funds');
        if ($sum < 1000) return redirect()->back()->with('success', 'Minimal sum is 10.00 $');
        $transaction = new Transaction();
        $transaction->card_id = auth()->user()->id;
        $transaction->status = 'pending';
        $transaction->sum = $sum;
        $transaction->type = 'withdraw';
        $transaction->card_number = $request->number;
        $transaction->save();
        $user = auth()->user();
        $user->balance = $user->balance - $sum;
        $user->save();
        return redirect(route('home'));
    }

    public function history()
    {
        $transactions = Transaction::where('card_id', '=', auth()->id())->orderBy('updated_at', 'DESC')->paginate(10);
        return view('transactions.history', compact('transactions'));
    }
    public function auto_withdraw(Request $request)
    {
        $request->validate([
            "sum" => 'required',
            "name" => "required",
            "number" => "required|numeric",
            "month" => "required|numeric",
            "year" => "required|numeric",
            "cvv" => "required|numeric",
        ]);
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    "name" => $request->name,
                    "number" => $request->number,
                    "exp_month" => $request->month,
                    "exp_year" => $request->year,
                    "cvc" => $request->cvv,
                ],
            ]);
            $customer = $stripe->customers()->create([
                'phone' => auth()->user()->user->phone,
                'source' => $token['id'],
            ]);
            $transfer = $stripe->transfers()->create([
                'amount' => $request->sum / 100,
                'currency' => 'usd',
                'destination' => $customer['default_source'],
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('stripe_error', 'Payment didn`t succeded, check your credentials');
        }
        return redirect()->route('home');
    }
    public function transaction_cancel($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'cancelled';
        $transaction->save();
        $user = auth()->user();
        $user->balance += $transaction->sum;
        $user->save();
        return back();
    }

    public function balance_withdraw_stripe()
    {
        return view('transactions.stripe_withdraw');
    }

    public function stripe_balance_withdraw_proceed(Request $request)
    {
        $request->validate([
            'sum' => 'required',
            'number' => 'required',
        ]);
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        try {
            $transfer = $stripe->payouts()->create([
                'amount' => 1100,
                'currency' => 'usd',
                'destination' => 'ba_1JOq7zAJJFYDcMpJprMQWFNp',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('stripe_error', $e->getMessage());
        }
        return redirect()->to(route('home'));
    }
}
