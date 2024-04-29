<?php

use App\Http\Controllers\MultiplayerMatchController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SingleplayerMatchController;
use App\Http\Controllers\UserPlayMatchController;
use App\Http\Controllers\CustomQuestionController;
use App\Http\Controllers\CustomQuizController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MatchController;
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


// users CRUD
Route::prefix('user')->group(function () {

    // user crud
    Route::get('/all',  [UserController::class, 'allUsers']);
    Route::get('/allpag',  [UserController::class, 'allUsersPaginated']);
    Route::get('/{username}',  [UserController::class, 'getByUsername']);
    Route::post('/create',  [UserController::class, 'createUser']);
    Route::delete('/del/{username}',  [UserController::class, 'deleteByUsername']);
    Route::patch('/upd/{username}',  [UserController::class, 'updateUser']);
    Route::patch('/stats/{username}',  [UserController::class, 'updateStats']);
    Route::post('/login',  [UserController::class, 'login']);

    // user - match get methods (many-to-many), rest of crud on UserPlayMatchController
    Route::get('/allmat/{id}/{type?}',  [UserController::class, 'getUserMatches']);

});

// matches CRUD
Route::prefix('match')->group(function () {

    Route::get('/all',  [MatchController::class, 'allMatches']);
    Route::get('/allpag',  [MatchController::class, 'allMatchesPaginated']);
    Route::get('/bytype/{type}',  [MatchController::class, 'allByType']);
    Route::post('/create',  [MatchController::class, 'createMatch']);

});

// singleMatches CRUD
Route::prefix('single')->group(function () {

    Route::post('/create',  [SingleplayerMatchController::class, 'createSingle']);

});


// multiMatches CRUD
Route::prefix('multi')->group(function () {

    Route::post('/create',  [MultiplayerMatchController::class, 'createMulti']);

});


// user_play_match CRUD
Route::prefix('usplmt')->group(function () {

    Route::get('/all',  [UserPlayMatchController::class, 'allUserPlayMatches']);
    Route::post('/create',  [UserPlayMatchController::class, 'createUserPlayMatch']);

});

// quiz CRUD
Route::prefix('quiz')->group(function () {

    Route::get('/all',  [QuizController::class, 'getAllQuizzes']);
    Route::get('/{id}',  [QuizController::class, 'getQuizById']);
    Route::post('/create',  [QuizController::class, 'createQuiz']);

});

// custom_quizzes CRUD
Route::prefix('cust')->group(function () {

    Route::get('/all',  [CustomQuizController::class, 'allCustoms']);
    Route::get('/all/{id_user}',  [CustomQuizController::class, 'allCustomsByUser']);
    Route::get('/{id}',  [CustomQuizController::class, 'getCustom']);
    Route::post('/create',  [CustomQuizController::class, 'createCustom']);
    Route::delete('/del/{id}',  [CustomQuizController::class, 'deleteCustom']);
    Route::patch('/upd/{id}',  [CustomQuizController::class, 'updateCustom']);
});

// question CRUD
Route::prefix('ques')->group(function () {

    Route::get('/all',  [QuestionController::class, 'allQuestions']);
    Route::get('/rand/{number}',  [QuestionController::class, 'getRandomQuestions']);
    Route::get('/{id}',  [QuestionController::class, 'getById']);
    Route::post('/create',  [QuestionController::class, 'createQuestion']);
    Route::patch('/upd/{id}',  [QuestionController::class, 'updateQuestion']);
    Route::delete('/del/{id}',  [QuestionController::class, 'deleteQuestion']);

});

// likes CRUD
Route::prefix('li')->group(function () {

    Route::get('/by/{fk_id_quiz}', [LikeController::class, 'likedBy']);
    Route::get('/likes/{fk_id_user}/', [LikeController::class, 'userLikes']);
    Route::post('/give', [LikeController::class, 'giveLike']);
    Route::delete('/dis/{fk_id_user}/{fk_id_quiz}', [LikeController::class, 'dislike']);

});

// custom_questions CRUD (questions created for users)
Route::prefix('usque')->group(function () {

    Route::get('/{id_quiz}',  [CustomQuestionController::class, 'getAllCustomQuestionsFromCustomQuiz']);
    Route::post('/create',  [CustomQuestionController::class, 'createCustomQuestion']);
    Route::patch('/upd/{id}',  [CustomQuestionController::class, 'updateCustomQuestion']);
    Route::delete('/del/{id}',  [CustomQuestionController::class, 'deleteCustomQuestion']);

});


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
