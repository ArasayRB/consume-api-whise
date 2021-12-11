<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
       ->get('/', [App\Http\Controllers\WhiseClient_Controller::class, 'apiWithJWT'])
       ->name('apiWithJWT');


/*Route::middleware(['auth:sanctum', 'verified'])->prefix('consume-api-whise')->group(function () {
    Route::get('estates/list', [App\Http\Controllers\WhiseClient_Controller::class, 'apiWithJWT'])->name('apiWithJWT');
});*/
