<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transaction_type_id',
        'note',
        'value',
        'created_at',
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function scopeTransactionTypeId($query, $transaction_type_id)
    {
        $query->when($transaction_type_id, function ($query) use ($transaction_type_id) { //when verifica se não é NULL
            $query->where('transactions.transaction_type_id', $transaction_type_id);
        });
    }

    public function scopeTransactionValue($query, $value)
    {
        $query->when($value, function ($query) use ($value) {
            $query->where('transactions.value', $value);
        });
    }

    public function scopeTransactionPeriod($query, $period)
    {
        $query->when($period[0] && $period[1], function ($query) use ($period) {
            $query->whereBetween('transactions.created_at', [Carbon::createFromFormat('Y-m-d', $period[0])->startOfDay(), Carbon::createFromFormat('Y-m-d', $period[1])->endOfDay()]);
        });
        /*
        $query->when($period[0] && $period[1], function ($query) use ($period) {
            $query->whereBetween('transactions.created_at', [$period[0], $period[1]]);
        });
        */
    }

    public function isDeposit(): bool 
    {
        return $this->transactionType->type_of == 0;
    }
}
