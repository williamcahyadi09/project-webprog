<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CartDetail;
use App\Transaction;
use App\TransactionDetail;
use App\Shoe;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $cart_list = CartDetail::where('user_id', $user->id)->get();
        $msg = '';
        $total_price = 0;
        foreach ($cart_list as $item) {
            $total_price = $total_price + $item->shoe->price * $item->quantity;
        }
        if ($cart_list->isEmpty()) {
            $msg = 'Your cart is empty';
            return view('cart', ['cart' => $cart_list, 'msg' => $msg, 'total_price' => $total_price]);
        } else {
            return view('cart', ['cart' => $cart_list, 'msg' => $msg, 'total_price' => $total_price]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shoe $shoe)
    {
        //
        return view('add_to_cart', ['shoe' => $shoe]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shoe $shoe)
    {

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $cart_detail = CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->first();

        if ($cart_detail != null) {
            CartDetail::where([
                ['user_id', $user->id],
                ['shoe_id', $shoe->id]
            ])->update([
                'quantity' => $cart_detail->quantity + $request->quantity
            ]);
        } else {
            CartDetail::create(
                [
                    'user_id' => $user->id,
                    'shoe_id' => $shoe->id,
                    'quantity' => $request->quantity
                ]
            );
        }
        return redirect('/cart')->with('status', 'Item successfully added to cart !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoe $shoe)
    {
        //
        $user = Auth::user();
        $cart_detail = CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->first();
        // dd($cart_detail);
        //dd($shoe);
        return view('edit_cart', ['cart_detail' => $cart_detail, 'shoe' => $shoe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoe $shoe)
    {
        //
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $user = Auth::user();
        CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->update([
            'quantity' => $request->quantity
        ]);
        return redirect('/cart')->with('status', 'Cart Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    {
        //
        $user = Auth::user();
        CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->delete();
        return redirect('/cart')->with('status', 'Item removed from cart !');
    }

    public function checkout()
    {

        Transaction::create([
            'user_id' => Auth::user()->id,
            'dateTime' => now()
        ]);


        $cartList = CartDetail::where([
            ['user_id', Auth::user()->id]
        ])->get();

        $latest_transaction = Transaction::where([
            ['user_id', Auth::user()->id]
        ])->latest('dateTime')->first();

        foreach ($cartList as $detail) {
            TransactionDetail::create([
                'transaction_id' => $latest_transaction->id,
                'shoe_id' => $detail->shoe_id,
                'quantity' => $detail->quantity
            ]);
        }

        CartDetail::where([
            ['user_id', Auth::user()->id]
        ])->delete();

        return redirect('/transactions')->with('status', 'Transaction successful');
    }
}
