<?php

namespace App\Http\Controllers;


use App\Exceptions\CustomNotFound;
use App\Models\Matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class MatchController extends Controller
{
    // Get
    public function allMatches(){
        $matches = Matchs::all();
        if (!$matches) throw new CustomNotFound('error: not matches found');
        return response()->json($matches);
    }

    public function allMatchesPaginated(Request $request)
    {
        $page = $request->input('page', 1);
        $matches = Matchs::paginate(2, ['*'], 'page', $page);
        return response()->json($matches);
    }


    public function allByType(String $type){
        $validateType = Validator::make([$type], Matchs::rulesForType());
        if ($validateType->fails()) return response()->json('error: type only can be single or multi', 422);
        $matches = Matchs::where('type', $type)->get();
        return response()->json($matches);
    }

    // Post
    public function createMatch(Request $request){
        $validateRequest = Validator::make($request->all(), Matchs::rulesForMatch());
        if ($validateRequest->fails()) return response()->json($validateRequest->errors(), 422);
        $match = Matchs::create($request->all());
        if (!$match) throw new Exception('error: couldnt create the match', 500);
        return response()->json($match, 201);
    }

    // no more CRUD methods, matches can't be deleted/updated

    // Get all quizzes/questions info related to a match
    public function getMatchRelatedInfo(int $id_match)
    {
        //$matches = Matchs::find($id_quiz)->quiz;
        //if (!$matches) throw new CustomNotFound('no matches related to this quiz');
        //return response()->json($matches);

        $match = Matchs::with('quiz.customQuiz', 'quiz.randomQuiz')->find($id_match);
        if (!$match) throw new CustomNotFound('no match found');

        $quizType = $match->quiz->customQuiz ? 'custom' : ($match->quiz->randomQuiz ? 'random' : null);
        $quiz = $quizType === 'custom' ? $match->customQuiz :  $match->randomQuiz;
        if (!$quiz) throw new CustomNotFound('no quiz found');

        $questions = $quiz->questions;
        if (!$quiz) throw new CustomNotFound('no questions found');

        return json_encode([
            'match' => $match,
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }


}
