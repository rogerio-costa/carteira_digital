<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Exports\TransactionsToXlsFromView;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\GetTransactionsDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportTransactionToXlsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, GetTransactionsDataService $getTransactionsDataService )
    {

        $formData = $getTransactionsDataService->run($request->all());

        $xls['success'] = true;
        echo json_encode($xls);

        return Excel::download(new TransactionsToXlsFromView($formData), 'transactions.xlsx');
    }
}
