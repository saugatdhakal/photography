<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validating the Request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        // Check Email
        $user = User::where('email', $credentials['email'])->first();

        //Check Password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response([
                'status' => 'error',
                'message' => 'Bad credentials'
            ], 401);
        }
        //If both cases pass then create token
        $token = $user->createToken('login_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }
    public function tokenStatus($token)
    {
        
        try{
        return User::checkTokenExpiers($token);
        }
        catch(\Exception $e){
            return false;
        }

    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }
    public function UpdateUserDetails(Request $request, $id)
    {
        $user = User::find($id);
        $user->updateUser($request);
        $response = [
            'status' => true,
            'message' => 'User updated successfully',
            'user' => $user
        ];
        return response($response, 201);
    }
}
