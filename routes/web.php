<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PurchaseController;


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




Route::get('adminlte', function () {
    return view('adminlte');
});

Route::post('forgot-password', function () {
    return view('forgot-password');
});


Route::get('/', function () {
    return view('welcome');
})->middleware('auth');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/contact/index', [ContactController::class,'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact');
    Route::post('/contact/complete', [ContactController::class,'complete'])->name('contact.complete');

    Route::get('/product/{id}/favorite', [FavoriteController::class, 'checkFavoriteStatus']);
    Route::post('/product/{id}/favorite', [FavoriteController::class, 'addToFavorites'])->name('product.add_to_favorites');
    Route::delete('/product/{id}/favorite', [FavoriteController::class,'removeFromFavorites'])->name('product.remove_from_favorites');

    Route::resource('product', ProductsController::class);


    Route::get('/purchase/{id}', [ProductsController::class, 'purchase'])->name('purchase');
    Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');


    Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




require __DIR__.'/auth.php';
