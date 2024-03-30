
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'showHomePage'])->name('homepage');
Route::get('/add-user', [UserController::class, 'showAddPage']);
Route::get('/edit-user/{id}', [UserController::class, 'showEditPage']);
Route::post('/store-user', [UserController::class, 'storeUser'])->name('store-user');
Route::post('/', [UserController::class, 'storeUser'])->name('store.user');
Route::put('/update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');





