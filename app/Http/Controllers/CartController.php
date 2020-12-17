<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CartDetail;
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
        //
        $user = Auth::user();
        $cartDetail = new CartDetail();
        $cartDetail->user_id = $user->id;
        $cartDetail->shoe_id = $shoe->id;
        $cartDetail->quantity = $request->quantity;

        $cartDetail->save();

        return redirect('/cart');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
