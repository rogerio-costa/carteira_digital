<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsToXlsFromView implements FromView
{
    private array $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        dd($this->data);
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();

        $transactions = Transaction::where('account_id', $account->id)->get();
        return view('pages.transactions.transactions-to-xls', [
            'transactions' => $transactions, 
        ]);
    }
}