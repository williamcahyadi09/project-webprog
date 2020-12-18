<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    //
    protected $fillable = ['user_id', 'shoe_id', 'quantity'];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
