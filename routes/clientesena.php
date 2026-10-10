<?php

use App\Http\Controllers\ClienteSenaAuthController;
use App\Http\Controllers\ClienteSenaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClienteSenaController::class, 'home'])->name('clientesena.root');
Route::redirect('/login', '/cliente-sena/login')->name('login');
Route::redirect('/categories', '/cliente-sena/categorias')->name('categories.index');
Route::redirect('/category/create', '/cliente-sena/categorias')->name('category.create');
Route::get('/category/{category}', fn () => redirect()->route('clientesena.categories'))
    ->whereNumber('category')
    ->name('category.show');
Route::get('/category/{category}/editar', fn () => redirect()->route('clientesena.categories'))
    ->whereNumber('category')
    ->name('category.edit');
Route::post('/category', fn () => abort(404))->name('category.store');
Route::put('/category/{category}', fn () => abort(404))
    ->whereNumber('category')
    ->name('category.update');
Route::delete('/category/{category}', fn () => abort(404))
    ->whereNumber('category')
    ->name('category.destroy');
Route::get('/posts', [ClienteSenaController::class, 'publications'])->name('posts');

Route::prefix('cliente-sena')
    ->name('clientesena.')
    ->controller(ClienteSenaController::class)
    ->group(function (): void {
        Route::get('/', 'home')->name('home');
        Route::get('/categorias', 'categories')->name('categories');
        Route::get('/publicaciones', 'publications')->name('publications');
        Route::get('/nosotros', 'about')->name('about');
        Route::get('/contacto', 'contact')->name('contact');
        Route::get('/datos/{resource}', 'catalog')
            ->whereIn('resource', ['cursos', 'areas', 'centros', 'equipos', 'instructores', 'aprendices'])
            ->name('catalog.index');
        Route::get('/datos/{resource}/{record}', 'show')
            ->whereIn('resource', ['cursos', 'areas', 'centros', 'equipos', 'instructores', 'aprendices'])
            ->whereNumber('record')
            ->name('catalog.show');
    });

Route::prefix('cliente-sena')
    ->name('clientesena.')
    ->controller(ClienteSenaAuthController::class)
    ->group(function (): void {
        Route::middleware('guest')->group(function (): void {
            Route::get('/login', 'showLogin')->name('login');
            Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.submit');
            Route::get('/registro', 'showRegistration')->name('register');
            Route::post('/registro', 'register')->middleware('throttle:5,1')->name('register.submit');
        });

        Route::post('/logout', 'logout')->middleware('auth')->name('logout');
    });
