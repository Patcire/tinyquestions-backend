<?php


namespace App\Http\Controllers;

use App\Exceptions\AlreadyExist;
use App\Exceptions\CustomNotFound;
use App\Models\CustomQuiz;
use App\Models\RandomQuiz;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UserController extends Controller
{
    // basic CRUD
    public function allUsers()
    {
        $users = User::all();
        if (!$users) throw new CustomNotFound('error: not users found');
        return response()->json($users);
    }

    public function allUsersPaginated(Request $request)
    {
        $page = $request->input('page', 1);
        $users = User::paginate(2, ['*'], 'page', $page);
        return response()->json($users);
    }

    public function createUser(Request $request)
    {

        $validator = Validator::make($request->only(['username', 'email', 'password']), User::rulesForUsers());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
        // Imprimir los valores para depuración

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
        // $userId = auth()->id();
        $userSelected = User::where('username', $username)->firstOrFail();
        $validator = Validator::make($request->only(['username', 'email', 'password']), User::rulesForUpdateUsers());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

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

    // Methods related with matches

    public function getUserMatches($userId,  $numberItems=null)
    {
        $user = User::find($userId);
        if (!$user) throw new CustomNotFound('user not found', 404);

        $matches = $user->matches();

        $matchesPaginated = $matches->paginate($numberItems ?? 10);
        if ($matchesPaginated->isEmpty()) throw new CustomNotFound('No quizzes found');

        foreach ($matchesPaginated as $match) {
            $quiz = $match->quiz;
            $match->load('quiz');

            if ($quiz->type === 'custom') {
                $customQuiz = CustomQuiz::where('id_quiz', $quiz->id_quiz)->first();
                $match->customQuiz = $customQuiz;
            } else {
                $randomQuiz = RandomQuiz::where('id_quiz', $quiz->id_quiz)->first();
                $match->randomQuiz = $randomQuiz;
            }

            unset($match->pivot);
        }
        return response()->json($matchesPaginated);
    }
}
