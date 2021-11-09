<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Saque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaqueController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        //$id = Auth::id(); 
        $conta = Conta::where('user_id', $user->id)->first();
        $saques = Saque::where('conta_id', $conta->id)->get();
        $qtd_saques = sizeof($saques);
        return view('saques.index', [
            'conta' => $conta,
            'qtd_saques' => $qtd_saques,
            'saques' => $saques
        ]);
    }


    public function create()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        $conta = Conta::where('user_id', $user->id)->first();
        return view('saques.saque', ['conta' => $conta]);
    }


    public function store(Request $request)
    {
        $usuario = Auth::user(); // Retrieve the currently authenticated user...
        $conta = Conta::where('user_id', $usuario->id)->first();
        $valor_saque = $request->input('valor_saque');
        if ($conta->saldo >= $valor_saque) {
            Saque::create([
                'conta_id' => $conta->id,
                'valor_saque' => $valor_saque,
            ]);

            $novo_saldo = $conta->saldo - $valor_saque;
            $conta->update(['saldo' => $novo_saldo]);

            return redirect()->route('contas.index')->with('success', 'Saque realizado com sucesso');
        } else {
            //return redirect()->route('saque.create')->with('msg', "Saldo insuficiente! Seu saldo atual é de ".number_format($conta->saldo, 2, ',', '.') );
            return redirect()->back()->withInput()->with('error', "Saldo insuficiente! Seu saldo atual é de " . number_format($conta->saldo, 2, ',', '.'));
        }
    }
}
