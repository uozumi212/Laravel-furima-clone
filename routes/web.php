<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;

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

Route::resource('product', ProductsController::class);

Route::get('/products/{id}/purchase', [ProductsController::class, 'purchase'])->name('purchase');



//Route::get('adminlte', function () {
//    return view('adminlte');
//});

//Route::get('/vue', function () {
//    return view('vue');
//});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact/index', [ContactController::class,'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact');
//Route::get('/contact/complete', [ContactController::class,'index'])->name('contact');
Route::post('/contact/complete', [ContactController::class,'complete'])->name('contact.complete');

Route::post('/product/{id}/add-to-favorites', [FavoriteController::class, 'addToFavorites'])->name('product.add_to_favorites');

Route::delete('/product/{id}/remove-from-favorites', [FavoriteController::class, 'removeFromFavorites'])->name('product.remove_from_favorites');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
