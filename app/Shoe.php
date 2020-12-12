<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    //
    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class);
    }
}
