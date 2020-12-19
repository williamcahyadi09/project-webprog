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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shoe $shoe)
    {
        //
        return view('add_shoe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:100',
            'description' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png'
        ]);

        $shoe = new Shoe;

        if ($request->file()) {
            $image = $request->file->getClientOriginalName();
            $request->file('file')->move('images', $image, 'public');
            Shoe::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image
            ]);
        }

        return redirect('/home')->with('status', 'Shoe successfully added');
    }

    public function edit(Shoe $shoe)
    {
        return view('edit_shoe', ['shoe' => $shoe]);
    }


    public function update(Request $request, Shoe $shoe)
    {
        $id = $shoe->id;
        $current_image = $shoe->image;

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:100',
            'description' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->file()) {
            $image = $request->file->getClientOriginalName();
            $request->file('file')->move('images', $image, 'public');

            $old_image_path = public_path() . '/' . $shoe->image;
            unlink($old_image_path);

            Shoe::find($shoe->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image
            ]);
        } else {
            Shoe::find($shoe->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $current_image
            ]);
        }

        //dd($shoe->id);
        return redirect()->route('shoe_detail', [$shoe])->with('status', 'Shoe updated');
    }
}
