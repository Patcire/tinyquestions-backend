<?php

namespace App\Http\Controllers;

use App\Models\QuizHasQuestion;
use Illuminate\Http\Request;

class QuizHasQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $quizzesHasQuestion = QuizHasQuestion::all();
        return response()->json($quizzesHasQuestion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $quizHasQuestion = QuizHasQuestion::create($request->all());
        return response()->json($quizHasQuestion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $quizHasQuestion = QuizHasQuestion::findOrFail($id);
        return response()->json($quizHasQuestion);
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
        $quizHasQuestion = QuizHasQuestion::findOrFail($id);
        $quizHasQuestion->update($request->all());
        return response()->json($quizHasQuestion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $quizHasQuestion = QuizHasQuestion::findOrFail($id);
        $quizHasQuestion->delete();
        return response()->json(null, 204);
    }
}
