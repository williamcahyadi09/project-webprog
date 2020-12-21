<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\TransactionDetail;

class TransactionController extends Controller
{
    //
    public function getUserTransaction()
    {
        $user = Auth::user();
        if ($user['role_id'] == config('enums.roles')['ADMIN']) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('user_id', $user['id'])->get();
        }
        foreach ($transactions as $transaction) {
            $transaction->transaction_details = TransactionDetail::where('transaction_id', $transaction['id'])->get();
            $total_price = 0;
            foreach ($transaction->transaction_details as $detail){
                $total_price = $total_price + $detail->quantity * $detail->shoe->price;
            }
            $transaction->total_price = $total_price;
        }
        return view('transaction', ['transactions' => $transactions]);
    }
}
