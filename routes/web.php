<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\TransactionController;
use App\Models\Price;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
    Route::get('/asd', function(){
        dd(auth()->user()->hasDefaultPaymentMethod());
     });
Route::middleware('auth:web')->group(function(){
    Route::get('/balance/refill', [TransactionController::class, 'refill_balance_show'])->name('refill.balance.show');
    Route::post('/balance/refill', [TransactionController::class, 'proceed_refill'])->name('refill.proceed');
    Route::get('/balance/withdraw', [TransactionController::class, 'balance_withdraw_show'])->name('balance.withdraw.show');
    Route::post('/balance/withdraw', [TransactionController::class, 'balance_withdraw'])->name('withdraw.proceed');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
    Route::get('/transactions/cancel/{id}', [TransactionController::class, 'transaction_cancel'])->name('transaction.cancel');
});
