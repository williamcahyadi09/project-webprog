<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
