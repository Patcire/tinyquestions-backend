<?php

namespace App\Http\Controllers;


use App\Models\Matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class MatchController extends Controller
{
    // Get
    public function allMatches(){
        $matches = Matchs::all();
        return response()->json($matches);
    }

    public function allByType(String $type){
        $matches = Matchs::where('type', $type)->get();
        return response()->json($matches);
    }

    // Post
    public function createMatch(Request $request){
        $validateRequest = Validator::make($request->all(), Matchs::rulesForMatch());
        if ($validateRequest->fails()) return response()->json($validateRequest->errors(), 400);
        $match = Matchs::create($request->all());
        if (!$match) throw new Exception('error: couldnt create the match', 500);
        return response()->json($match, 201);
    }

    // no more methods, matches can't be deleted/updated

}
