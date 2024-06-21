<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        if(User::where('email',$request->email)->count()>0){
            return response()->json(['error_email'=>true]);
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = auth('api')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ]);   
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email','password');

        $token = auth('api')->attempt($credentials);

        if(!$token){
            return response()->json([
                'status' => 'erorr',
                'message' => 'Login Failed'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Login in successfully',
            'token' => $token

        ]);
    }

    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
    	return response(JWTAuth::getToken(), Response::HTTP_OK);
    }
}
