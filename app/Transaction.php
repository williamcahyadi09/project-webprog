<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['user_id', 'dateTime'];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
