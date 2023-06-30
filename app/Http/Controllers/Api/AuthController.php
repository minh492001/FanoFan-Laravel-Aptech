<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register(UserRequest $request)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];
        /** @var \App\Models\User $user * */
        // $user = User::create($data);
//        $user = $this->user->createUser($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        $customer = new Customer();
        $name = explode(" ", $user->name);
        $customer->first_name = $name[0];
        $customer->last_name = $name[1] ?? '';
        $customer->save();

        return response([
            'user' => $user,
            'message' => 'Your new account has been registered successfully!'
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email|string|exists:users,email',
                'password' => [
                    'required',
                ],
                'remember' => 'boolean'
            ],
            [
                'email.required' => 'Email must be fill...',
                'email.email' => 'email invalid!',
                'password.required' => 'password can not be empty...',
            ]
        );
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email of Password incorrect!'
            ], 422);
        }

        /** @var \App\Models\User $user * */
        $user = Auth::user();
//        if (!$user->is_admin){
//            Auth::logout();
//            return response([
//                'message' => 'You don\'t have permission to authenticate as Admin'
//            ],403);
//        }
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
            'message' => 'Login successfully...'
        ], 200);
    }

    public function logout()
    {
        /** @var \App\Models\User $user * */
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response('Logout successfully', 202);
    }

    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
