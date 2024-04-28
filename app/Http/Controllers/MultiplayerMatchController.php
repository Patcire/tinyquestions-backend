<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\MultiplayerMatch;
use App\Models\SingleplayerMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MultiplayerMatchController extends Controller
{
    public function createMulti(Request $request)
    {
        $validatedMultiMatch = Validator::make($request->all(), MultiplayerMatch::rulesForMulti());
        if ($validatedMultiMatch->fails()) {
            return response()->json($validatedMultiMatch->errors(), 422);
        }

        $multi = MultiplayerMatch::create($request->all());
        if (!$multi) throw new CustomException('it couldnt be created', 500);

        return response()->json($multi);

    }
}
