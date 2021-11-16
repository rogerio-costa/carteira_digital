<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(function () {

    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should be able to return Transaction index', function () {
    Account::factory()->for($this->user)->create();

    get(route('transactions.index'))->assertOk()->assertViewIs('pages.transactions.index')->assertViewHas(
        [
            'account',
            'transactions',
            'transaction_types',
            'qtd_inbound_transactions',
            'qtd_outbound_transactions'
        ]
    );
});

it('should be able to return Transaction create', function () {
    get(route('transactions.create'))->assertOk()->assertViewIs('pages.transactions.create')->assertViewHas(
        [
            'transaction_types'
        ]
    );;
});

it('should be able to return Transaction store of deposit with success', function () {
    $myAcoount = Account::factory()->for($this->user)->create();
    $request = Transaction::factory()->for($myAcoount)->deposit()->make()->toArray();

    post(route('transactions.store'),$request)->assertRedirect(route('transactions.index'))->assertSessionHas('success');

    $myTransaction = Transaction::latest()->firstOrFail()->toArray();
    expect($myTransaction)->toMatchArray($request);
});

it('should be able to return Transaction store of withdraw with success', function () {
    $myAcoount = Account::factory()->for($this->user)->create(['balance'=>1000]);
    $request = Transaction::factory()->for($myAcoount)->withdraw()->make()->toArray();

    post(route('transactions.store'),$request)->assertRedirect(route('transactions.index'))->assertSessionHas('success');

    $myTransaction = Transaction::latest()->firstOrFail()->toArray();
    expect($myTransaction)->toMatchArray($request);
});

it('should not be able to store Transaction withdraw with insufficient balance', function () {
    $myAcoount = Account::factory()->for($this->user)->create(['balance'=>0]);
    $request = Transaction::factory()->for($myAcoount)->withdraw()->make(['value'=>10])->toArray();

    post(route('transactions.store'),$request)->assertRedirect()->assertSessionHas('errors');
    assertDatabaseCount('transactions',0);
});
