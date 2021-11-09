<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saque extends Model
{
    use HasFactory;

    protected $fillable = [
        'conta_id',
        'valor_saque',
    ];


    public function conta() {
        return $this->belongsTo('App\Models\Conta');
    }

}
