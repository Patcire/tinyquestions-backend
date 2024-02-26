<?php

namespace App\Http\Controllers;


use App\Exceptions\CustomNotFound;
use App\Exceptions\SQLInfraction;
use App\Models\CustomQuiz;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isEmpty;

class LikeController extends Controller
{

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
        if (empty($usersLiked)) throw new CustomNotFound('no users liked this');
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
        if (empty($quizzesLiked)) throw new CustomNotFound('this user has not liked quizzes');
        return response()->json($quizzesLiked);
    }
    public function giveLike(Request $request)
    {
        $request->validate([
            'fk_id_user' => 'required|integer',
            'fk_id_quiz' => 'required|integer',
        ]);

        $like = Like::create($request->all());

        if (!$like) throw new \Mockery\Exception('not created', 500);

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
        }
        throw new \Mockery\Exception('not disliked');

    }


}
