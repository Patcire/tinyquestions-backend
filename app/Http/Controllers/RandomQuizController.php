<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Models\RandomQuiz;
use Exception;
use Illuminate\Http\Request;

class RandomQuizController extends Controller
{
    public function allRandoms()
    {
        $customQuizzes = RandomQuiz::all();
        if (!$customQuizzes) throw new CustomNotFound('no quizzes found');
        return response()->json($customQuizzes);
    }

    public function allRandomsByUser($id_user)
    {
        $customQuizzes = RandomQuiz::where('fk_id_user', $id_user)->get();
        if (!$customQuizzes) throw new CustomNotFound('no quizzes found for the user');
        return response()->json($customQuizzes);
    }

    public function createRandom(Request $request)
    {
        $customQuiz = RandomQuiz::create($request->all());
        if (!$customQuiz) throw new Exception('not created', 500);
        $request->validate(RandomQuiz::rules());
        return response()->json($customQuiz, 201);
    }

    public function getRandom($id_custom)
    {
        $customQuiz = RandomQuiz::findOrFail($id_custom);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');
        return response()->json($customQuiz);
    }


    public function updateRandom(Request $request, $id)
    {
        $customQuiz = RandomQuiz::findOrFail($id);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');
        $customQuiz->update($request->all());
        $request->validate(RandomQuiz::rulesForUpdate());
        return response()->json($customQuiz, 200);
    }


    public function deleteRandom($id)
    {
        $customQuiz = RandomQuiz::findOrFail($id);
        if (!$customQuiz) throw new CustomNotFound('no quiz found');
        $customQuiz->delete();

        return response()->json(null, 204);
    }
}
