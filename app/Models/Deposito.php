<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    protected $fillable = [
        'conta_id',
        'valor_deposito',
    ];

    public function conta() {
        return $this->belongsTo('App\Models\Conta');
    }
    
}
