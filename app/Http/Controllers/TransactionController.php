<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Http\Requests\TransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user(); 
        $account = Account::where('user_id', $user->id)->first();
        $transactions = Transaction::where('account_id', $account->id)->get();
        $transaction_types = TransactionType::all();

        // Transações de entrada
        $qtd_inbound_transactions = sizeof(Transaction::where('type_of', 0)->get());

        // Transações de saída
        $qtd_outbound_transactions = sizeof(Transaction::where('type_of', 1)->get());

        
        return view('pages.transactions.index', [
            'account' => $account,
            'transactions' => $transactions,
            'transaction_types' => $transaction_types,
            'qtd_inbound_transactions' => $qtd_inbound_transactions,
            'qtd_outbound_transactions' => $qtd_outbound_transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction_types = TransactionType::all();
        return view('pages.transactions.create', [
            'transaction_types' => $transaction_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $form = $request->validated();
        $form['account_id'] = $account->id;
        $transaction_type = TransactionType::where('id', $form['transaction_type_id'])->first();
        $transaction_name = $transaction_type->name;
        $transaction_type_of = "";
       

        if ($transaction_type->type_of == 0) {
            // entrada
            $transaction_type_of = "Entrada";
            $form['type_of'] = 0;
            $form['transaction_name'] = "{$transaction_name} - {$transaction_type_of}";

            Transaction::create($form);
            
            $new_balance = $account->balance + $form['value'];
            $account->update(['balance' => $new_balance]);
            return redirect()->route('transactions.index')->with('success', 'Transação de entrada cadastrada com sucesso');

        } elseif ($transaction_type->type_of == 1) {
            // saída

            if ($account->balance >= $form['value']) {
                $transaction_type_of = "Saída";
                $form['type_of'] = 1;
                $form['transaction_name'] = "{$transaction_name} - {$transaction_type_of}";

                Transaction::create($form);

                $new_balance = $account->balance - $form['value'];
                $account->update(['balance' => $new_balance]);
                return redirect()->route('transactions.index')->with('success', 'Transação de saída cadastrada com sucesso');

            } else {
                return redirect()->back()->withInput()->withErrors("Saldo insuficiente! Seu saldo atual é de R$ " . number_format($account->balance, 2, ',', '.'));
            }

        } else {
            return redirect()->back()->withInput()->withErrors("Erro com o tipo da transação, contate o desenvolvedor!");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    
}
