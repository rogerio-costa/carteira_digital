<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetTransactionsDataService
{
    public function run(Account $account, array $data): Collection
    {
        return $account->transactions()
            ->transactionTypeId($data['transaction_type_id'])
            ->transactionValue($data['value'])
            ->transactionPeriod([$data['initialDate'], $data['finalDate']])
            ->get();
    }
}
