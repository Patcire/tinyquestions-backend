<?php


namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class UserController extends Controller
{

    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $request->validate(User::rulesForUsers());
        $data = $request->only([
            'username',
            'email',
            'password',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        if (!$user) throw new Exception('error: couldnt create the user', 500);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'success login']);
        }
        return response()->json(['message' => 'not correct credentials'], 401);
    }

    public function getByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if (!$user) throw new CustomNotFound('user not found');
        return response()->json($user);
    }

    public function updateUser(Request $request, $username)
    {

        $userSelected = User::where('username', $username)->firstOrFail();
        if (!$userSelected) throw new CustomNotFound('user not found');
       $request->validate(User::rulesForUpdateUsers());
        $userSelected-> fill($request->only([
            'username',
            'email',
            'password',
        ]));
        $userSelected->save();
        return response()->json($userSelected);
    }

    public function updateStats(Request $request, $username)
    {

        $userSelected = User::where('username', $username)->firstOrFail();
        if (!$userSelected) throw new CustomNotFound('user not found');

        $userSelected-> fill($request->only([
            'points',
            'quizzes_resolved'
        ]));
        $userSelected->save();
        return response()->json($userSelected);
    }


    public function deleteByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if (!$user) throw new CustomNotFound('user not found');
        $user->delete();
        return response()->json(null, 204);
    }
}
