<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        //$id = Auth::id(); 
        $conta = Account::where('user_id', $user->id)->first();
        /*
        $depositos = Deposito::where('conta_id', $conta->id)->get();
        $saques = Saque::where('conta_id', $conta->id)->get();
        $qtd_saques = sizeof($saques);
        $qtd_depositos = sizeof($depositos);
        return view('conta_digital.index', [
            'conta' => $conta,
            'qtd_depositos' => $qtd_depositos,
            'depositos' => $depositos,
            'qtd_saques' => $qtd_saques,
            'saques' => $saques
        ]);*/
        return view('pages.accounts.index');
    }
}
