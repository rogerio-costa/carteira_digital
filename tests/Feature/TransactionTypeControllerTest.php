<?php

namespace Tests\Feature;

use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

// class TransactionTypeControllerTest extends TestCase
// {
//     use RefreshDatabase;

//     public function test_transaction_type_index()
//     {
//         // queremos criar um usuário
//         /** @var User */
//         $user = User::factory()->create();
//         // autenticar
//         $this->actingAs($user);

//         // ir para a página /transaction-types
//         $response = $this->get('/transaction-types');

//         // queremos pegar o que conseguimos com status 200
//         $response->assertStatus(200);
//     }

//     public function test_transaction_type_create()
//     {
//         // queremos criar um usuário
//         /** @var User */
//         $user = User::factory()->create();
//         // autenticar
//         $this->actingAs($user);

//         // ir para a página /transaction-types
//         $response = $this->get('/transaction-types/create');

//         // queremos pegar o que conseguimos com status 200
//         $response->assertStatus(200);
//     }

//     public function test_transaction_type_store()
//     {
//         // queremos criar um usuário
//         /** @var User */
//         $user = User::factory()->create();
//         // autenticar
//         $this->actingAs($user);

//         // acertar na url /transaction-types com requisição POST
//         $response = $this->post('/transaction-types', [
//             'name' => 'Teste de entrada com teste',
//             'type_of' => 0
//         ]);

//         // queremos afirmar que fomos redirecionados para a url /transaction-types
//         $response->assertStatus(302);

//         // temos que encontrar o último tipo de transação criado
//         $transaction_type = TransactionType::first();

//         // queremos afirmar que o tipo de transação tem os dados corretos
//         $this->assertEquals('Teste de entrada com teste', $transaction_type->name);
//         $this->assertEquals(0, $transaction_type->type_of);

//     }
// }

beforeEach(function () {
    $this->user = User::factory()
        ->create();
    $this->actingAs($this->user);
});

it('should be able to return TransactionType index', function () {
    get(route('transaction-types.index'))->assertOk()->assertViewHas(['account', 'transaction_types']);
});

it('should be able to return TransactionType create', function () {
    get(route('transaction-types.create'))->assertOk();
});

it('should be able to return TransactionType store', function () {
    $request =
        [
            'name' => 'Teste de entrada com teste',
            'type_of' => 0
        ];
    post(route('transaction-types.store'), $request)->assertRedirect(route('transaction-types.index'))->assertSessionHas('success');

    assertDatabaseHas('transaction_types', $request);
});

it('should not be able to store Transaction with the name field blank', function () {
    $request =
        [
            'name' => '',
            'type_of' => 0
        ];

    post(route('transaction-types.store'),$request)->assertRedirect()->assertSessionHas('errors');
    assertDatabaseCount('transaction_types',0);
});
