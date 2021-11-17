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

    public function create()
    {
        $transaction_types = TransactionType::all();
        return view('pages.transactions.create', ['transaction_types' => $transaction_types]);
    }

    public function store(TransactionRequest $request)
    {
        $account = auth()->user()->account;

        $newBalance = $account->getNewBalance($request->value, TransactionType::find($request->transaction_type_id));

        if ($newBalance < 0) {
             return redirect()->back()->withInput()->withErrors("Saldo insuficiente! Seu saldo atual é de R$ " . number_format($account->balance, 2, ',', '.'));
        }

        $account->transactions()->create($request->validated());

        $account->update(['balance' => $newBalance]);

        return redirect()->route('transactions.index')->with('success', 'Transação de entrada cadastrada com sucesso');
    }
}
