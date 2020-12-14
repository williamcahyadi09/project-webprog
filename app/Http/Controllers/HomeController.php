<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shoe;
use App\Transaction;
use App\TransactionDetail;
use App\User;

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

    // show all shoes
    public function index()
    {
        $allShoes = Shoe::paginate(6);
        return view('home', ['shoes' => $allShoes]);
    }

    // get shoe by name
    public function getShoeByName(string $name)
    {
        $name = strtolower($name);
        $shoes = Shoe::where('name', 'LIKE', '%' . $name . '%')->get();
        //dd($shoes);
        return view('home', ['shoes' => $shoes]);
    }

    // view user history transaction
    public function getUserTransaction()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user['id'])->get();

        //$transactionDetails = TransactionDetail::where('transaction_id', $transactions['id'])->get();
        foreach ($transactions as $transaction) {
            $transaction->transaction_details = TransactionDetail::where('transaction_id', $transaction['id'])->get();
        }
        dd($transactions);
        return view('all_transaction', ['transactions' => $transactions]);
    }
}
