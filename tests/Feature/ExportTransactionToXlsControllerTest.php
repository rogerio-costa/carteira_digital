<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should be able to download a exel document', function () {

    Excel::fake();
    Account::factory()->for($this->user)->create();

    //$transactionType = TransactionType::factory()->create();
    //$transaction = Transaction::factory()->for($account)->for($transactionType)->create();

    get(route('transactions.xls-export'))->assertOk();

    Excel::assertDownloaded('transactions.xlsx');
});