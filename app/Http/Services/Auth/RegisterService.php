<?php


namespace App\Http\Services\Auth;


use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * @param $fields
     * @return User
     */
    public function registerUser($fields) : User
    {
        $user = User::create([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);
        return $user;
    }

}
