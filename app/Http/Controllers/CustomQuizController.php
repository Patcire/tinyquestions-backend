<?php

namespace App\Http\Controllers;

use App\Models\CustomQuiz;
use Illuminate\Http\Request;

class CustomQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customQuizzes = CustomQuiz::all();
        return response()->json($customQuizzes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $customQuiz = CustomQuiz::create($request->all());
        return response()->json($customQuiz, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        return response()->json($customQuiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        $customQuiz->update($request->all());
        return response()->json($customQuiz, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        $customQuiz->delete();
        return response()->json(null, 204);
    }
}
