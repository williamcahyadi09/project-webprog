<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\TransactionDetail;

class TransactionController extends Controller
{
    // function yang menampilkan seluruh transaksi user
    public function getUserTransaction()
    {
        $user = Auth::user();
        // kalau role user admin maka lihat smua transaksi yang dilakukan oleh semua user, selain itu
        // lihat semua transaksi yang dilakukan user
        if ($user['role_id'] == config('enums.roles')['ADMIN']) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('user_id', $user['id'])->get();
        }

        // loop transaksi - transaksi sehingga data yang dikirim dapat berupa transaksi dan detail dari transaksi tersebut
        foreach ($transactions as $transaction) {
            $transaction->transaction_details = TransactionDetail::where('transaction_id', $transaction['id'])->get();
            $total_price = 0;
            foreach ($transaction->transaction_details as $detail) {
                $total_price = $total_price + $detail->quantity * $detail->shoe->price;
            }
            $transaction->total_price = $total_price;
        }
        return view('transaction', ['transactions' => $transactions]);
    }
}
