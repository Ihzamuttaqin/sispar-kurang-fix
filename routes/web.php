<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [DestinationController::class, 'all'])->name('welcome');
Route::get('/destination/detail/{id}', [DestinationController::class, 'show'])->name('destinations.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //route transaksi
    Route::get('/destination/order/{destination}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/destination/order/save/{destination}', [TransactionController::class, 'store'])->name('transactions.store');

    //rout payment
    Route::get('payment/{transaction}', [TransactionController::class, 'payment'])->name('payment');
    Route::post('process-payment/{transaction}', [TransactionController::class, 'processPayment'])->name('process-payment');

    // route receipt
    Route::get('receipt/{transaction}', [TransactionController::class, 'receipt'])->name('receipt');

    //rout order
    Route::post('order/{destination}', [TransactionController::class, 'order'])->name('order');
});
route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/dashboard/admin', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    // route punya users buat manggil table

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // route punya destination
    Route::resource('destinations', DestinationController::class)->except('show', 'welcome');

    // rout punya transakri
    Route::resource('transactions', TransactionController::class)->except('create','store');


});

route::middleware(['auth','role:manger'])->group(function(){

    Route::get('/dashboard/manager', function () {
        return view('dashboard');
    })->name('manager.dashboard');

});



require __DIR__.'/auth.php';
