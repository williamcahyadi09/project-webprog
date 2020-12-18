<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    protected $table = 'transaction_details';
    protected $fillable = ['transaction_id', 'shoe_id', 'quantity'];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
