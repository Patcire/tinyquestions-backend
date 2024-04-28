<?php

namespace App\Http\Controllers;

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
    //public function allMatchesByUser(int $id_user){
    //    $matchesByUser  = UserPlayMatch::where('id_user', $id_user)->get();
    //    if($matchesByUser->isEmpty()) return response()->json('error: no data found', 404);
    //    $matchesData = [];
    //    // to avoid make another petition we search here the matches info
    //    foreach($matchesByUser as $match){
    //        $matchData = [
    //            'id_user_plays_match' => $match->id_user_plays_match,
    //            'id_user' => $match->id_user,
    //            'id_match' => $match->id_match,
    //            'date' => $match->date,
    //            'points' => $match->points,
    //            'responses' => json_decode($match->responses, true)
    //        ];
    //        $matchesData[] = $matchData;
    //    }
//
    //    return response()->json($matchesData);
//
    //}
//
    public function createUserPlayMatch(Request $request){

        $validatedRequest = Validator::make($request->all(), UserPlayMatch::rules());
        if ($validatedRequest->fails()) {
            return response()->json($validatedRequest->errors(), 422);
        }

        $userPlayMatch = UserPlayMatch::create($request->all());
        if (!$userPlayMatch) throw new CustomException('coudnt be created', 500);
        return response()->json($userPlayMatch);

    }



}
