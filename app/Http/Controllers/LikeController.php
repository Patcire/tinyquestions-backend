<?php

namespace App\Http\Controllers;


use App\Models\CustomQuiz;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function all()
    {
        $likes = Like::all();
        return response()->json($likes);
    }

    public function likedBy($id_quiz)
    {
        $likes = Like::where('fk_id_quiz', $id_quiz)->get();

        $usersLiked = [];
        foreach ($likes as $like) {
            $user = User::find($like->fk_id_user);
            if ($user) {
                $usersLiked[] = $user;
            }
        }
        return response()->json($usersLiked);
    }

    public function userLikes($id_user)
    {
        $likes = Like::where('fk_id_user', $id_user)->get();
        $quizzesLiked = [];
        foreach ($likes as $like){
            $quiz = CustomQuiz::find($like->fk_id_quiz);
            $quiz && $quizzesLiked[] = $quiz;
        }

        return response()->json($quizzesLiked);
    }
    public function giveLike(Request $request)
    {
        $request->validate([
            'fk_id_user' => 'required|integer',
            'fk_id_quiz' => 'required|integer',
        ]);

        $like = Like::create($request->all());

        return response()->json($like, 201);
    }
    public function dislike($fk_id_user, $fk_id_quiz)
    {
        $like = Like::where('fk_id_user', $fk_id_user)
            ->where('fk_id_quiz', $fk_id_quiz)
            ->first();
        if ($like) {
            $like->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Like not found'], 404);
        }

    }


}
