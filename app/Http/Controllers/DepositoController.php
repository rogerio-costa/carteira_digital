<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Deposito;
use App\Models\Saque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class DepositoController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        $conta = Conta::where('user_id', $user->id)->first();
        $depositos = Deposito::where('conta_id', $conta->id)->get();
        $qtd_depositos = sizeof($depositos);
        return view('depositos.index', [
            'conta' => $conta,
            'qtd_depositos' => $qtd_depositos,
            'depositos' => $depositos,
        ]);
    }


    public function create()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        $conta = Conta::where('user_id', $user->id)->first();
        return view('depositos.deposito', ['conta' => $conta]);
    }


    public function store(Request $request)
    {
        $usuario = Auth::user(); // Retrieve the currently authenticated user...
        $conta = Conta::where('user_id', $usuario->id)->first();
        $valor_deposito = $request->input('valor_deposito');
        Deposito::create([
            'conta_id' => $conta->id,
            'valor_deposito' => $valor_deposito,
        ]);

        $novo_saldo = $conta->saldo+$valor_deposito;
        $conta->update(['saldo' => $novo_saldo]);
        
        return redirect()->route('contas.index')->with('success', 'Deposito realizado com sucesso');
    }
}
