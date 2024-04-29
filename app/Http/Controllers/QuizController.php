<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Exceptions\CustomNotFound;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class QuizController extends Controller
{

    public function getAllQuizzes(Request $request)
    {
        $page = $request->input('page', 1);
        $quizzes = Quiz::paginate(2, ['*'], 'page', $page);;
        if (!$quizzes) throw new CustomNotFound('no quizzes were found');
        return response()->json($quizzes);
    }


    public function getQuizById(int $id)
    {

        $quiz = Quiz::find($id);
        if (!$quiz) throw new CustomNotFound('the quiz dont exist');
        return response()->json($quiz);
    }


    public function createQuiz(Request $request)
    {
        $validatedQuiz = Validator::make($request->all(), Quiz::rulesForQuizzes());
        if ($validatedQuiz->fails()) return response()->json($validatedQuiz->errors(), 422);

        $quiz = Quiz::create($request->all());
        if (!$quiz) throw new CustomException('the quiz coudnt be created', 500);
        return response()->json($quiz);
    }



}
