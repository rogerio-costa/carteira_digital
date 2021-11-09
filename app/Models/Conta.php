<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'saldo',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function deposito()
    {
        return $this->hasMany('App\Models\Deposito');
    }


    public function saque()
    {
        return $this->hasMany('App\Models\Saque');
    }
}
