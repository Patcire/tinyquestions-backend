<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pepe', function () {
    return view('pepe');
});

use Illuminate\Support\Facades\DB;

Route::get('/sel', function () {

    $resultados = DB::select('SELECT * FROM questions');

    return response()->json($resultados);
});


Route::get('/socket.io/socket.js', function () {
    return response()->file(public_path('socket.js'));
});
