<?php
namespace App\Http\Controllers;
use App\Exceptions\CustomException;
use App\Exceptions\CustomNotFound;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function allQuestionsByType(bool $boolean): \Illuminate\Http\JsonResponse
    {
        $results = Question::where('isCustom', $boolean)->get();
        if (!$results) throw new CustomNotFound('No question found');
        return response()->json($results);
    }

    public function getRandomQuestions($numberQuestionsNeeded): \Illuminate\Http\JsonResponse
    {
        //only questions from the app, no questions created by users
        $totalQuestions = $this->allQuestionsByType(0);
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
        $validatedQuestion = Validator::make($request->all(), Question::rules());
        if ($validatedQuestion->fails()) {
            return response()->json($validatedQuestion->errors(), 422);
        }
        $question = Question::create($request->all());
        if (!$question) throw new CustomException('question wasnt created', 500);
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

