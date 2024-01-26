<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\ArticleOfInventoryController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // go to form page to create inventory and articles
    Route::get('invetory', [InventoryCategoryController::class, 'index'])->name('inventory.page');
    Route::post('invetory', [InventoryCategoryController::class, 'store'])->name('inventory.store');
    Route::put('invetory/{inventory}', [InventoryCategoryController::class, 'updateInventory'])->name('inventory.update');
    Route::delete('invetory/{inventory}', [InventoryCategoryController::class, 'destroy'])->name('inventory.delete');
    Route::post('invetory/{inventory}/articles', [
        InventoryCategoryController::class, 'storeArticle'
    ])->name('inventory.article.store');
    Route::put('article/{article}', [
        InventoryCategoryController::class, 'updateArticle'
    ])->name('inventory.article.update');
    Route::delete('articles/{article}', [
        InventoryCategoryController::class, 'deleteArticle'
    ])->name('article.delete');

    // map with categories and articles
    Route::get('where-i-am', [
        ArticleOfInventoryController::class, 'index'
    ])->name('map.with.inventory');
});

require __DIR__.'/auth.php';
