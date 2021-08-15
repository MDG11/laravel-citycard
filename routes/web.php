<?php

use App\Http\Controllers\admin\CardController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\admin\CardTypeController;
use App\Http\Controllers\admin\PriceController;
use App\Http\Controllers\admin\VehicleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\admin\VehicleTypeController;
use App\Http\Controllers\admin\WithdrawController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
        Route::middleware("auth:admin")->group(function(){
            Route::resource('/cities', CityController::class)->except('show');
            Route::resource('/cards', CardController::class)->except('show');
            Route::resource('/card-types', CardTypeController::class)->except('show');
            Route::resource('/vehicle-types', VehicleTypeController::class)->except('show');
            Route::resource('/vehicles', VehicleController::class)->except('show');
            Route::resource('/prices', PriceController::class)->only('index', 'update');
            Route::get('/withdraws', [WithdrawController::class, 'index'])->name('withdraws.index');
            Route::get('/withdraws/approve/{withdraw}', [WithdrawController::class, 'approve'])->name('withdraws.approve');
            Route::get('/withdraws/decline/{withdraw}', [WithdrawController::class, 'decline'])->name('withdraws.decline');
        });
    });

Route::middleware('auth:web')->group(function(){
    Route::get('/balance/refill', [TransactionController::class, 'refill_balance_show'])->name('refill.balance.show');
    Route::post('/balance/refill', [TransactionController::class, 'proceed_refill'])->name('refill.proceed');
    Route::view('/balance/withdraw/choose', 'transactions.withdraw_choose')->name('balance.withdraw.choose');
    Route::get('/balance/withdraw/stripe', [TransactionController::class, 'balance_withdraw_stripe'])->name('stripe.withdraw.show');
    Route::post('/balance/withdraw/stripe', [TransactionController::class, 'stripe_balance_withdraw_proceed'])->name('stripe.withdraw.proceed');
    Route::get('/balance/withdraw/card', [TransactionController::class, 'balance_withdraw_show'])->name('balance.withdraw.show');
    Route::post('/balance/withdraw/card', [TransactionController::class, 'balance_withdraw'])->name('withdraw.proceed');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
    Route::get('/transactions/cancel/{id}', [TransactionController::class, 'transaction_cancel'])->name('transaction.cancel');
    Route::view('/withdraw/card/automatically', 'transactions.auto_withdraw_form')->name('auto_withdraw');
    Route::post('/withdraw/card/automatically', [TransactionController::class, 'auto_withdraw'])->name('auto_withdraw.proceed');

    Route::get('/ride/show', [RidesController::class, 'show'])->name('rides.show');
    Route::get('/ride/pay/{vehicle_id}', [RidesController::class, 'pay'])->name('rides.pay');
    Route::get('/ride/history', [RidesController::class, 'history'])->name('rides.history');
});
