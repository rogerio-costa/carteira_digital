<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function getNewBalance(float $value, TransactionType $transactionType)
    {
        return $this->balance + ($transactionType->type_of ? -1*$value : $value);
    }
}
