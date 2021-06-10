<?php


namespace App\Http\Services\Auth;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * @param $fields
     * @return false|User|null
     */
    public function loginUser($fields)
    {
        $email = $fields['email'];
        $password = $fields['password'];
        $user = Auth::attempt(['email' => $email, 'password' => $password]);
        if(!$user){
            return false;
        }
        return Auth::user();

    }

    /**
     * @param $email
     * @return string
     */
    public function checkEmail($email):string{
        $user = User::email($email)->first();
        if($user){
            return 'Вы ввели неверный пароль';
        }
        return 'Пользователя с такой почтой не существует';
    }

    /**
     * @param User $user
     * @param $remember_me
     * @return string
     */
    public function createToken(User $user, $remember_me): string
    {
        $token = $user->createToken(config('app.name'));
        if($remember_me){
            $token->token->expires_at = Carbon::now()->addMonth();
        }
        $token->token->expires_at = Carbon::now()->addDay();
        $token->token->create();
        return 'Bearer '. $token->accessToken;
    }
}
