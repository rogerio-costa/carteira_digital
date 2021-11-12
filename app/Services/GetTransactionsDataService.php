<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class GetTransactionsDataService
{
    public function run(array $data)
    {
        $user = Auth::user();
        $account = Account::where('user_id', $user->id)->first();
        $period = [$data['initialDate'], $data['finalDate']];
        
        $transactions = Transaction::where(
            'account_id',
            $account->id
        )
            ->transactionTypeId($data['transaction_type_id'])
            ->transactionValue($data['value'])
            ->transactionPeriod($period)
            ->get();

        return $transactions;
    }
}
