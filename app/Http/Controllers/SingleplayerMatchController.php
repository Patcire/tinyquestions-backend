<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\SingleplayerMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SingleplayerMatchController extends Controller
{
    public function createSingle(Request $request)
    {
        $validatedSingleMatch = Validator::make($request->all(), SingleplayerMatch::rulesForSingle());
        if ($validatedSingleMatch->fails()) {
            return response()->json($validatedSingleMatch->errors(), 422);
        }

        $single = SingleplayerMatch::create($request->all());
        if (!$single) throw new CustomException('it couldnt be created', 500);

        return response()->json($single);

    }
}
