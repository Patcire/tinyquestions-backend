<?php


namespace App\Http\Controllers;

use App\Exceptions\CustomNotFound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


    public function getByUsername($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if (!$user) throw new CustomNotFound('user not found');
        return response()->json($user);
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'success login',
                'user' => [
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    'points' => $user->points,
                    'quizzes_resolved' => $user->quizzes_resolved
                ]
            ]);
        } else {
            return response()->json(['message' => 'Incorrect password'], 401);
        }
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
