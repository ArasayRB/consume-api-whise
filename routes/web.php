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
Route::redirect('/dashboard','/dashboard/estates');
Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard/estates')
       ->group(function(){
         Route::get('/', WhiseList::class)->name('dashboard');
         Route::get('/list', [App\Http\Controllers\WhiseClient_Controller::class, 'apiWithJWT'])
         ->name('apiWithJWT');
         Route::resource('/properties', App\Http\Controllers\PropertyController::class,['except'=>['edit', 'update', 'create']]);
         Route::get('/sync', [App\Http\Controllers\WhiseClient_Controller::class, 'whiseWithJWT'])->name('sync');
         Route::resource('/tasks', App\Http\Controllers\TasksController::class,['except'=>['index']]);
         Route::prefix('tasks')->group(function()
       {
         Route::get('/{name}/{id}/{purpose}/{status}',[App\Http\Controllers\TasksController::class, 'index'])->name('indexTasks');
         Route::get('/list/{id}',[App\Http\Controllers\TasksController::class, 'getTasksByProperty'])->name('getTasksByProperty');
       });
       });
