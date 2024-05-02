<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Models\CustomQuiz;
use Exception;
use Illuminate\Http\Request;

class CustomQuizController extends Controller
{

    public function allCustoms()
    {
        $customQuizzes = CustomQuiz::all();
        if (!$customQuizzes) throw new CustomNotFound('no quizzes found');
        return response()->json($customQuizzes);
    }

    public function allCustomsByUser($id_user)
    {
        $customQuizzes = CustomQuiz::where('fk_id_user', $id_user)->get();
        if (!$customQuizzes) throw new CustomNotFound('no quizzes found for the user');
        return response()->json($customQuizzes);
    }

    public function createCustom(Request $request)
    {
        $customQuiz = CustomQuiz::create($request->all());
        if (!$customQuiz) throw new Exception('not created', 500);
        $request->validate(CustomQuiz::rules());
        return response()->json($customQuiz, 201);
    }

    public function getCustom($id_custom)
    {

        $customQuiz = CustomQuiz::findOrFail($id_custom);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');

        // the recovery will include the questions info too
        $quizPlusQuestions = $customQuiz->toArray();
        $quizPlusQuestions['questions'] = $customQuiz->questions->toArray();
        return response()->json($quizPlusQuestions);
    }


    public function updateCustom(Request $request, $id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');
        $customQuiz->update($request->all());
        $request->validate(CustomQuiz::rulesForUpdate());
        return response()->json($customQuiz, 200);
    }


    public function deleteCustom($id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');
        $customQuiz->delete();

        return response()->json(null, 204);
    }
}
