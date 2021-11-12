<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\ExportTransactionToPdfController;
use App\Http\Controllers\ExportTransactionToXlsController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/', [AccountController::class, 'index']);

    // Routes ACCOUNT
    Route::resource('accounts', AccountController::class)->only('index');

    // Route Export Transactions To XLS
    Route::get('transactions/xls-export', ExportTransactionToXlsController::class)->name('transactions.xls-export');

    // Route Export Transactions To pdf
    Route::get('transactions/pdf-export', ExportTransactionToPdfController::class)->name('transactions.pdf-export');
    
    // Routes TRANSACTION
    Route::resource('transactions', TransactionController::class);

    // Routes TRANSACTION TYPE
    Route::resource('transaction_types', TransactionTypeController::class);
});
