<?php

use App\Http\Controllers\MoviesController;
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

Route::get('/', [MoviesController::class, 'index']);
Route::group(['middleware' => 'auth', 'prefix' => 'movies'], function() {
    Route::get('', [MoviesController::class, 'movies']);
    Route::get('/create', [MoviesController::class, 'create']);
    Route::post('', [MoviesController::class, 'save']);
    Route::get('/edit/{url}', [MoviesController::class, 'edit']);
    Route::put('/update/{url}', [MoviesController::class, 'save']);
    Route::delete('/delete/{url}', [MoviesController::class, 'destroy']);
});
Route::get('/movies/{url}', [MoviesController::class, 'show']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
