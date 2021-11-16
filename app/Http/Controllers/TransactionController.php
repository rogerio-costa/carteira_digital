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
        $account = Account::where('user_id', auth()->id())->with('transactions.transactionType')->first();
        $transactions = $account->transactions;
        $transaction_types = TransactionType::all();
        $qtd_inbound_transactions = $account->transactions->where('transactionType.type_of', 0)->count();
        $qtd_outbound_transactions = $account->transactions->where('transactionType.type_of', 1)->count();

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
        return view('pages.transactions.create', ['transaction_types' => $transaction_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $account = auth()->user()->account;

        $newBalance = $account->getNewBalance($request->value, TransactionType::find($request->transaction_type_id));

        // if ($newBalance < 0) {
        //     return redirect()->back()->withInput()->withErrors("Saldo insuficiente! Seu saldo atual é de R$ " . number_format($account->balance, 2, ',', '.'));
        // }

        $account->transactions()->create($request->validated());

        $account->update(['balance' => $newBalance]);

        return redirect()->route('transactions.index')->with('success', 'Transação de entrada cadastrada com sucesso');
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
