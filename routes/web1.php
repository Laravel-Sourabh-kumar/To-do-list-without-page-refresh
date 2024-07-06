<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
 
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

Route::get('/', function () {
    return redirect('login');
});
Route::get('/logout', function () {
    Auth::Logout();
    return redirect('login');
});

Route::get('/dashboard', function () {
    return redirect('todo');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('user',UserController::class);

// Todo Resources
Route::resource('todo', TodoController::class);
Route::get('todo-create', [TodoController::class,'store']);
Route::any('todo-update/{id}', [TodoController::class,'update']);
Route::any('todo-delete/{id}', [TodoController::class,'destroy']);

require __DIR__.'/auth.php';
