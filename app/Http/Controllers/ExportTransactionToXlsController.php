<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Exports\TransactionsToXlsFromView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportTransactionToXlsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $xls['success'] = false;
        $xls['message'] = "{$request->transaction_type_id} - {$request->value} - {$request->initialDate} - {$request->finalDate}";
        $data = $request->all();

        return Excel::download(new TransactionsToXlsFromView($data), 'transactions.xlsx');
    }
}
