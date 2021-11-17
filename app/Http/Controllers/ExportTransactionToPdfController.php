<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsToPdfFromView;
use App\Models\Transaction;
use App\Services\GetTransactionsDataService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportTransactionToPdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, GetTransactionsDataService $getTransactionsDataService)
    {
        $account = auth()->user()->account;
        $transactions = $getTransactionsDataService->run($account, $request->all());
        $periodTotal = $transactions->sum(fn (Transaction $transaction) => $transaction->isDeposit() ? $transaction->value : -$transaction->value);

        return Excel::download(new TransactionsToPdfFromView($transactions,$periodTotal), 'transactions.pdf');
    }
}
