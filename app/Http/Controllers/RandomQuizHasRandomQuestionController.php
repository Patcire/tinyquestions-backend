<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Exceptions\CustomNotFound;
use App\Models\RandomQuizHasRandomQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RandomQuizHasRandomQuestionController extends Controller
{
    public function createHas(Request $request)
    {
        $validatedInput = Validator::make($request->all(), RandomQuizHasRandomQuestion::rules());
        if ($validatedInput->fails()) {
            return response()->json($validatedInput->errors(), 422);
        }
        $question = RandomQuizHasRandomQuestion::create($request->all());
        if (!$question) throw new CustomException('question wasnt created', 500);
        return response()->json($question, 201);
    }

    public function QuizHasQuestions(int $id_quiz)
    {
        $results = RandomQuizHasRandomQuestion::where('isCustom', $id_quiz)->get();
        if (!$results) throw new CustomNotFound('No questions found');
        return response()->json($results);
    }


}
