<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'list'], function () {
    Route::get('get-divisions', [MemberController::class, 'getDivisions']);
});

//save-members
Route::post('save-members', [MemberController::class, 'saveMembers']);

//get-members
Route::get('get-members', [MemberController::class, 'getMembers']);

Route::get('edit-members/{value}', [MemberController::class, 'editMembers']);
Route::delete('delete-members/{value}', [MemberController::class, 'deleteMembers']);
//update-members
Route::put('update-members', [MemberController::class, 'updateMembers']);

// save-products
Route::post('save-products', [ProductController::class, 'create']);
//get-products
Route::get('get-products/{id}', [ProductController::class, 'getProducts']);
//product_details
Route::get('product_details/{id}', [ProductController::class, 'productDetails']);
