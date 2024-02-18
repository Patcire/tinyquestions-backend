<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $user = User::create($request->all([
            'username',
            'email',
            'password',
        ]));
        $request->validate(User::rulesForUsers());
        return response()->json($user, 201);
    }


    public function getByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return response()->json($user);
    }

    public function updateUser(Request $request, $username)
    {

        $userSelected = User::where('username', $username)->firstOrFail();
       $request->validate(User::rulesForUsers());
        $userSelected-> fill($request->only([
            'username',
            'email',
            'password',
        ]));
        $userSelected->save();
        return response()->json($userSelected);
    }


    public function deleteByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();
        return response()->json(null, 204);
    }
}
