<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function allQuizzes()
    {
        $quizzes = Quiz::with('quizType')->get();
        return response()->json($quizzes);
    }

    public function createQuiz(Request $request)
    {
        $quiz = Quiz::create($request->all());
        $request->validate(Quiz::rules());
        return response()->json($quiz, 201);
    }

    public function getQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return response()->json($quiz);
    }
    /*
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());
        return response()->json($quiz, 200);
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return response()->json(null, 204);
    }
    */
}
