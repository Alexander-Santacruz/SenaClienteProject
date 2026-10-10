<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('category/create',[CategoriesController::class,'create'])->name('category.create');
Route::post('category', [CategoriesController::class, 'store'])->name('category.store');
Route::get('category/{category}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('category/{category}/editar',[CategoriesController::class,'edit'])->name('category.edit');
Route::put('category/{category}', [CategoriesController::class, 'update'])->name('category.update');
Route::delete('category/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');



Route::get('posts', [PostController::class, 'index'])->name('categories');
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::get('mision_vision', [HomeController::class, 'mision_vision'])->name('home.mision_vision');
Route::get('contact', [HomeController::class, 'contact'])->name('home.contact');
