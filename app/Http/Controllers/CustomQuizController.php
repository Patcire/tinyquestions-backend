<?php

namespace App\Http\Controllers;

use App\Models\CustomQuiz;
use Illuminate\Http\Request;

class CustomQuizController extends Controller
{

    public function allCustoms()
    {
        $customQuizzes = CustomQuiz::all();
        return response()->json($customQuizzes);
    }

    public function createCustom(Request $request)
    {
        $customQuiz = CustomQuiz::create($request->all());
        $request->validate(CustomQuiz::rules());
        return response()->json($customQuiz, 201);
    }

    public function getCustom($id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        return response()->json($customQuiz);
    }


    public function updateCustom(Request $request, $id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        $customQuiz->update($request->all());
        $request->validate(CustomQuiz::rules());
        return response()->json($customQuiz, 200);
    }


    public function deleteCustom($id)
    {
        $customQuiz = CustomQuiz::findOrFail($id);
        $customQuiz->delete();
        return response()->json(null, 204);
    }
}
