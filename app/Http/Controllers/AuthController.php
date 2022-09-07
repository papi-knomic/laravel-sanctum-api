<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( Request $request )
    {
        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
            ]);

        $token = $user->createToken( 'prodToken' )->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response( $response, 201 );
    }

    public function login( Request $request )
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

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
