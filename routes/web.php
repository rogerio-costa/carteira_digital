<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\SaqueController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Rotas CONTA

//Route::middleware(['auth:sanctum', 'verified'])->get('/', [ContaController::class, 'index'])->name('contas.index');



// Rotas DEPOSITO
Route::middleware(['auth:sanctum', 'verified'])->get('/depositos', [DepositoController::class, 'index'])->name('deposito.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/depositos/create', [DepositoController::class, 'create'])->name('deposito.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/depositos/store', [DepositoController::class, 'store'])->name('deposito.store');

// Rotas SAQUE
Route::middleware(['auth:sanctum', 'verified'])->get('/saques', [SaqueController::class, 'index'])->name('saque.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/saques/create', [SaqueController::class, 'create'])->name('saque.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/saques/store', [SaqueController::class, 'store'])->name('saque.store');


Route::middleware(['auth:sanctum', 'verified'])->group( function () {

    Route::get('/', [AccountController::class, 'index']);

    // Routes ACCOUNT
    Route::resource('accounts', AccountController::class)->only('index');

    // Routes TRANSACTION
    Route::resource('transactions', TransactionController::class);

    // Routes TRANSACTION TYPE
    Route::resource('transaction_types', TransactionTypeController::class);

});