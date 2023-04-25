<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members');
Route::get('/members-data', [App\Http\Controllers\MemberController::class, 'membersData'])->name('members-data');
Route::get('/home', [App\Http\Controllers\MemberController::class, 'index'])->name('home');
Route::get('/edit-members/{id}', [App\Http\Controllers\MemberController::class, 'editMembers'])->name('edit-members');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'index'])->name('products');


Auth::routes();
