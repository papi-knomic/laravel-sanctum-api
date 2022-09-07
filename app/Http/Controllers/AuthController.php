<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( StoreUserRequest $request )
    {
        $fields = $request->validated();

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
            ]);

        $token = $user->createToken('prodToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response( $response, 201 );
    }

    public function login( LoginUserRequest $request )
    {
        $fields = $request->validated();

       //check email
        $user = User::where( 'email', $fields['email'] )->first();

        if ( !$user || !Hash::check( $fields['password'], $user->password ) ) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }
        //check password

        $token = $user->createToken( 'prodToken' )->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response( $response, 201 );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(
            [
                'message' => 'User logged out',
                'status' => true
            ],
            200
        );
    }
}
