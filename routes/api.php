<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', [TaskController::class, 'index'])->name('api.tasks.index');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('api.tasks.get');
Route::post('/tasks', [TaskController::class, 'store'])->name('api.tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('api.tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('api.tasks.destroy');
