<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements \App\Interfaces\UserRepositoryInterface
{

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function login(array $data)
    {
        $user = User::where( 'email', $data['email'] )->first();

        if ( !$user || !Hash::check( $data['password'], $user->password ) ) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return $user;
    }

    public function update(int $id,array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
}
