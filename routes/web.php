<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\WhiseList;

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
Route::redirect('/','/dashboard/estates');
Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard/estates')
       ->group(function(){
         Route::get('/', WhiseList::class)->name('dashboard');
         Route::get('/tasks',function()
         {
           return view('app');
         });
         Route::get('/list', [App\Http\Controllers\WhiseClient_Controller::class, 'apiWithJWT'])
         ->name('apiWithJWT');
       });
