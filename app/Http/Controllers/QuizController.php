<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Exceptions\CustomNotFound;
use App\Models\CustomQuiz;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class QuizController extends Controller
{

    public function getAllQuizzes(Request $request)
    {
        $page = $request->input('page', 1);
        $quizzes = Quiz::paginate(10, ['*'], 'page', $page);;
        if (!$quizzes) throw new CustomNotFound('no quizzes were found');
        return response()->json($quizzes);
    }


    public function getQuizById(int $id)
    {
        // include all chained info ( info of subtype, questions )
        $quiz = Quiz::find($id);
        if (!$quiz) throw new CustomNotFound('the quiz was not found');

        $quizInfo = $quiz->toArray();

        ($quiz instanceof CustomQuiz) ?
            $quizInfo = $quizInfo['quiz_details'] = $quiz->customQuiz->toArray()
            :
            $quizInfo['quiz_details'] = $quiz->randomQuiz->toArray();
        return response()->json($quizInfo);
    }


    public function createQuiz(Request $request)
    {
        $validatedQuiz = Validator::make($request->all(), Quiz::rulesForQuizzes());
        if ($validatedQuiz->fails()) return response()->json($validatedQuiz->errors(), 422);

        $quiz = Quiz::create($request->all());
        if (!$quiz) throw new CustomException('the quiz coudnt be created', 500);
        return response()->json($quiz, 201);
    }



}
