<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Pest\Laravel\get;

beforeEach(function () {

    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should be able to return Account index', function () {
    $this->account = Account::factory()->for($this->user)->create();

    get(route('accounts.index'))->assertOk()->assertViewIs('pages.accounts.index')->assertViewHas([
        'account',
        'transactions',
        'qtd_inbound_transactions',
        'qtd_outbound_transactions'
    ]);
});
