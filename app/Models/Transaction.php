<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transaction_type_id',
        'transaction_name',
        'type_of',
        'note',
        'value'
    ];

    public function transaction_type()
    {
        return $this->hasOne('App\Models\TransactionType');
    }

}
