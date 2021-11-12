<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsToXlsFromView;
use App\Services\GetTransactionsDataService;
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
    
    public function __invoke(Request $request, GetTransactionsDataService $getTransactionsDataService )
    {

        $formData = $getTransactionsDataService->run($request->all());
        $periodTotal =0;
        foreach ($formData as $transaction) {
            if ($transaction->type_of == 0){
                $periodTotal = $periodTotal + $transaction->value;
            }else{
                $periodTotal = $periodTotal - $transaction->value;
            }
            
          }

        return Excel::download(new TransactionsToXlsFromView($formData,$periodTotal), 'transactions.xlsx');
    }
}
