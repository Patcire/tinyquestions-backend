<?php

namespace App\Http\Controllers;

use App\Models\CustomQuestion;
use Illuminate\Http\Request;

class CustomQuestionController extends Controller
{
    public function allCustomQuestions(): \Illuminate\Http\JsonResponse
    {
        $results = CustomQuestion::all();
        return response()->json($results);
    }


    public function createCustomQuestion(Request $request)
    {
        $question = CustomQuestion::create($request->all());
        return response()->json($question, 201);
    }

    public function getAllCustomQuestionsFromCustomQuiz($id_quiz)
    {
        $question = CustomQuestion::where('fk_id_quiz', $id_quiz)->get();
        return response()->json($question, 201);
    }


    public function updateCustomQuestion(Request $request, $id)
    {
        $question = CustomQuestion::findOrFail($id);

        $request->validate(CustomQuestion::rules());

        $question->fill($request->only([
            'title',
            'option_a',
            'option_b',
            'option_c',
            'correct_option',
        ]));

        $question->save();
        return response()->json($question);

    }

    public function deleteCustomQuestion($id)
    {
        $question = CustomQuestion::findOrFail($id);
        $question->delete();
        return response()->json(null, 204);
    }

}
