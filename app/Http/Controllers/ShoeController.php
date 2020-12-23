<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoe;

class ShoeController extends Controller
{
    // menampilkan seluruh koleksi sepatu yang ada pada website
    public function index()
    {
        $allShoes = Shoe::paginate(6);
        return view('home', ['shoes' => $allShoes]);
    }

    // fungsi untuk mencari sepatu dari nama nya
    public function getShoeByName(string $name)
    {
        $name = strtolower($name);
        $shoes = Shoe::where('name', 'LIKE', '%' . $name . '%')->paginate(6);
        return view('home', ['shoes' => $shoes]);
    }

    // me return detail sepatu
    public function getShoeDetail(Shoe $shoe)
    {
        return view('shoe_detail', ['shoe' => $shoe]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menampilkan form untuk membuat sepatu
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

    // fungsi untuk menambahkan data sepatu pada tabel sepatu
    public function store(Request $request)
    {
        // validasi field-field sepatu
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:100',
            'description' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png' // file harus berupa image sehingga extension nya harus berupa jpg, jpeg atau png
        ]);

        $shoe = new Shoe;

        // kalau file ada dan sudah lolos validasi
        if ($request->file()) {
            $image = $request->file->getClientOriginalName(); // untuk mendapat nama file
            $request->file('file')->move('images', $image, 'public'); // simpan nama file di public/images
            // add sepatu ke database
            Shoe::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image
            ]);
        }

        return redirect('/home')->with('status', 'Shoe successfully added');
    }

    // menampilkan form edit sepatu
    public function edit(Shoe $shoe)
    {
        return view('edit_shoe', ['shoe' => $shoe]);
    }

    // function update data sepatu 
    public function update(Request $request, Shoe $shoe)
    {
        $id = $shoe->id;
        $current_image = $shoe->image;

        // validasi field-field sepatu
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer|min:100',
            'description' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        // kalau admin mau ganti gambar
        if ($request->file()) {
            $image = $request->file->getClientOriginalName();
            $request->file('file')->move('images', $image, 'public');

            $old_image_path = public_path() . '/images' . '/' . $shoe->image;
            unlink($old_image_path); // function menghapus filename file lama

            // update sepatu
            Shoe::find($shoe->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image
            ]);
        }
        // kalau admin gmw ganti gambar 
        else {
            // update sepatu
            Shoe::find($shoe->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $current_image
            ]);
        }

        return redirect()->route('shoe_detail', [$shoe])->with('status', 'Shoe updated');
    }
}
