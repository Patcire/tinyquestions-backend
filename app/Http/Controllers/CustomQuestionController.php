<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Exceptions\SQLInfraction;
use App\Models\CustomQuestion;
use Illuminate\Http\Request;
use Mockery\Exception;

class CustomQuestionController extends Controller
{


    public function createCustomQuestion(Request $request)
    {
        $question = CustomQuestion::create($request->all());
        if (!$question) throw new Exception('not created', 500);
        return response()->json($question, 201);
    }

    public function getAllCustomQuestionsFromCustomQuiz($id_quiz)
    {
        $questions = CustomQuestion::where('fk_id_quiz', $id_quiz)->get();
        if (empty($questions)) throw new CustomNotFound('not questions found');
        return response()->json($questions, 201);
    }


    public function updateCustomQuestion(Request $request, $id)
    {
        $question = CustomQuestion::findOrFail($id);
        if (!$question) throw new CustomNotFound('not questions found');
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
        if (!$question) throw new CustomNotFound('not questions found');
        $question->delete();
        return response()->json(null, 204);
    }

}
