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
    private $data;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }
    public function view(): View
    {
        return view('pages.transactions.transactions-to-xls', [
            'transactions' => $this->formData,
        ]);
    }
}
