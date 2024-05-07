<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Models\CustomQuiz;
use App\Models\RandomQuiz;
use App\Models\UserPlayMatch;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserPlayMatchController extends Controller
{
    public function allUserPlayMatches(){
        $matchesByUser  = UserPlayMatch::all();
        return response()->json($matchesByUser);
    }

    public function createUserPlayMatch(Request $request){

        $validatedRequest = Validator::make($request->all(), UserPlayMatch::rules());
        if ($validatedRequest->fails()) {
            return response()->json($validatedRequest->errors(), 422);
        }

        $userPlayMatch = UserPlayMatch::create($request->all());
        if (!$userPlayMatch) throw new CustomException('coudnt be created', 500);
        return response()->json($userPlayMatch);

    }

    public function getUserMatches($userId, $numberItems=null)
    {
        $userMatches = UserPlayMatch::where('id_user', $userId);
        if (!$userMatches) throw new CustomNotFound('user not found', 404);

        $userMatchesPaginated = $userMatches->with('match')->paginate($numberItems ?? 10);
        if ($userMatchesPaginated->isEmpty()) throw new CustomNotFound('No matches found');

        foreach ($userMatchesPaginated as $match) {
            $quiz = $match->match->quiz;

            if ($quiz->type === 'custom') {
                $customQuiz = CustomQuiz::where('id_quiz', $quiz->id_quiz)->first();
                $match->customQuiz = $customQuiz;
            } else {
                $randomQuiz = RandomQuiz::where('id_quiz', $quiz->id_quiz)->first();
                $match->randomQuiz = $randomQuiz;
            }

            unset($match->pivot);
        }


        return response()->json($userMatchesPaginated);
    }



}
