<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsToXlsFromView implements FromView
{
    private $data;

    public function __construct($formData, $periodTotal)
    {
        $this->formData = $formData;
        $this->periodTotal = $periodTotal;
    }

    public function view(): View
    {
        return view('pages.transactions.transactions-to-xls', [
            'transactions' => $this->formData, 'periodTotal' => $this->periodTotal
        ]);
    }
}
