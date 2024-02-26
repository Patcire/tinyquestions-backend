<?php

namespace App\Http\Controllers;
use App\Exceptions\SQLInfraction;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    public function allQuestions(): \Illuminate\Http\JsonResponse
    {
        $results = Question::all();
        return response()->json($results);
    }

    public function getRandomQuestions($numberQuestionsNeeded): \Illuminate\Http\JsonResponse
    {
        $totalQuestions = $this->allQuestions();
        $arrayOfAllQuestions = json_decode($totalQuestions->getContent(), true);;


        shuffle($arrayOfAllQuestions);

        $questionsChoosed = [];
        $counter = 0;
        while (count($questionsChoosed)<$numberQuestionsNeeded){

            $questionsChoosed[]=$arrayOfAllQuestions[$counter];
            $counter++;
        }

        return response()-> json($questionsChoosed);

    }

    public function createQuestion(Request $request)
    {
        $question = Question::create($request->all());
        return response()->json($question, 201);
    }


    public function getById($id)
    {
        $question = Question::findOrFail($id);
        return response()->json($question);
    }


    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate(Question::rulesForUsers());

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

    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(null, 204);
    }



}

