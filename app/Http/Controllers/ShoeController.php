<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoe;

class ShoeController extends Controller
{
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

    public function getShoeDetail(Shoe $shoe)
    {
        // dd($shoe);
        return view('shoe_detail', ['shoe' => $shoe]);
    }
}
