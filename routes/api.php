<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// IMPORTANT: all routes must use prefix "/api" too ej--> /api/ques/all

// question CRUD
Route::prefix('ques')->group(function () {

    Route::get('/all',  [QuestionController::class, 'allQuestions']);
    Route::get('/rand/{number}',  [QuestionController::class, 'getRandomQuestions']);
    Route::get('/{id}',  [QuestionController::class, 'getById']);
    Route::post('/create',  [QuestionController::class, 'createQuestion']);
    Route::patch('/upd/{id}',  [QuestionController::class, 'updateQuestion']);
    Route::delete('/del/{id}',  [QuestionController::class, 'deleteQuestion']);

});

// users CRUD
Route::prefix('user')->group(function () {

    Route::get('/all',  [UserController::class, 'allUsers']);
    Route::get('/{nick}',  [UserController::class, 'getByUsername']);
    Route::post('/create',  [UserController::class, 'createUser']);
    Route::delete('/del/{username}',  [UserController::class, 'deleteByUsername']);
    Route::patch('/upd/{nick}',  [UserController::class, 'updateUser']);
});








/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
