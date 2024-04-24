<?php


namespace App\Http\Controllers;

use App\Exceptions\AlreadyExist;
use App\Exceptions\CustomNotFound;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
        if (User::where('username', $request->username)->exists()) {
            throw new AlreadyExist('Error: user already exist');
        }
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
        try{
            $user = User::where('username', $username)->firstOrFail();
            return response()->json($user);
        }
        catch (ModelNotFoundException $e){
            throw new CustomNotFound('User not found');
        }


    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'not match'], 404);
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
        try{
            $user = User::where('username', $username)->firstOrFail();

            $user->delete();
            return response()->json('delete successfully', 204);
        }
        catch (ModelNotFoundException $e){
            throw new CustomNotFound('Username not found');
        }

    }
}
