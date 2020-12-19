<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    //


    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class);
    }
}
