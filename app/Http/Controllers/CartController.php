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

    // function untuk menampilkan isi dari cart user
    public function index()
    {
        // mengambil user yang sedang login saat ini
        $user = Auth::user();

        // mengambil cartDetail yang memiliki user_id sama seperti id user yang sedang login
        $cart_list = CartDetail::where('user_id', $user->id)->get();
        $msg = '';
        $total_price = 0;

        // hitung total price
        foreach ($cart_list as $item) {
            $total_price = $total_price + $item->shoe->price * $item->quantity;
        }

        // kalau cart kosong tampilin message "Your cart is empty", kalau tidak kosong tampilin isi dari cart beserta harga nya
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

    // function yang menampilkan form pengisian untuk add to cart
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

    // function yang berfungsi untuk menambahkan data ke tabel cartDetail pada database
    public function store(Request $request, Shoe $shoe)
    {
        // memvalidasi bahwa quantity harus diisi, harus berupa integer dan memiliki nilai minimal 1
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // mengambil user yang login saat ini
        $user = Auth::user();

        // query untuk mengambil cartDetail yang nanti dipakai untuk diambil quantity nya
        // jadi jika sepatu X sudah ada di cart dan user masih mau menambahkan sepatu X maka data
        // sepatu X pada tabel cartDetails akan di tambahkan quantity nya dengan input quantity yang baru

        $cart_detail = CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->first();

        // kalau sepatu tersebut belum pernah ditambahkan ke cart
        if ($cart_detail != null) {
            CartDetail::where([
                ['user_id', $user->id],
                ['shoe_id', $shoe->id]
            ])->update([
                'quantity' => $cart_detail->quantity + $request->quantity
            ]);
        }
        // kalau sepatu sudah pernah ditambah ke cart 
        else {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // function untuk menampilkan form untuk mengupdate sepatu yang ada di cart
    public function edit(Shoe $shoe)
    {
        //
        $user = Auth::user();
        $cart_detail = CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->first();

        return view('edit_cart', ['cart_detail' => $cart_detail, 'shoe' => $shoe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // function untuk mengupdate data sepatu yang ada di tabel cartDetail
    public function update(Request $request, Shoe $shoe)
    {
        // validasi quantity. Quantity harus diisi, harus berupa integer, dan minimal 1  
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        // mengambil user yang login sekarang
        $user = Auth::user();
        // Mengambil data cartDetail yang memiliki user_id sama seperti id user yang login sekarang
        // dan shoe_id yang sama dengan request
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

    // function untuk menghapus item yang ada di cart
    public function destroy(Shoe $shoe)
    {
        // mengambil user yang sedang login sekarang
        $user = Auth::user();
        // menghapus cartDetail yang user_id sm dengan id user sekarang dan shoe_id yang dipilih user
        CartDetail::where([
            ['user_id', $user->id],
            ['shoe_id', $shoe->id]
        ])->delete();
        return redirect('/cart')->with('status', 'Item removed from cart !');
    }

    // function untuk checkout, cara kerja nya adalah membuat transaksi yang berisi semua barang yang ada di cart
    // dan menghapus semua barang yang ada di cart
    public function checkout()
    {
        // mengambil barang-barang yang ada di cart user sekarang
        $cartList = CartDetail::where([
            ['user_id', Auth::user()->id]
        ])->get();

        // Buat transaksi terbaru
        Transaction::create([
            'user_id' => Auth::user()->id,
            'dateTime' => now()
        ]);

        // ambil transaksi terkahir user (transaksi yang dibuat di atas)
        $latest_transaction = Transaction::where([
            ['user_id', Auth::user()->id]
        ])->latest('dateTime')->first();

        // menambahkan item-item ke transaction detail dari transaction yang sudah kita ambil
        foreach ($cartList as $detail) {
            TransactionDetail::create([
                'transaction_id' => $latest_transaction->id,
                'shoe_id' => $detail->shoe_id,
                'quantity' => $detail->quantity
            ]);
        }

        // mengkosongkan cart user
        CartDetail::where([
            ['user_id', Auth::user()->id]
        ])->delete();

        return redirect('/transactions')->with('status', 'Transaction successful');
    }
}
