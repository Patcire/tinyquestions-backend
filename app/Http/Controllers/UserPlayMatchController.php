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
