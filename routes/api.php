<?php

use App\Http\Controllers\CustomQuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
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
    Route::get('/{username}',  [UserController::class, 'getByUsername']);
    Route::post('/create',  [UserController::class, 'createUser']);
    Route::delete('/del/{username}',  [UserController::class, 'deleteByUsername']);
    Route::patch('/upd/{username}',  [UserController::class, 'updateUser']);
});


// quizzes CRUD
Route::prefix('quiz')->group(function () {

    Route::get('/all',  [QuizController::class, 'allQuizzes']);
    Route::get('/{id}',  [QuizController::class, 'getQuiz']);
    Route::post('/create',  [QuizController::class, 'createQuiz']);
    //Route::delete('/del/{id}',  [UserController::class, 'deleteQuiz']);
    //Route::patch('/upd/{id}',  [UserController::class, 'updateQuiz']);
});

// custom_quizzes CRUD
Route::prefix('cust')->group(function () {

    Route::get('/all',  [CustomQuizController::class, 'allCustoms']);
    Route::get('/{id}',  [CustomQuizController::class, 'getCustom']);
    Route::post('/create',  [CustomQuizController::class, 'createCustom']);
    Route::delete('/del/{id}',  [CustomQuizController::class, 'deleteCustom']);
    Route::patch('/upd/{id}',  [CustomQuizController::class, 'updateCustom']);
});






/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
