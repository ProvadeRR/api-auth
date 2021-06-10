<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\api\ApiController;
use App\Http\Services\Auth\LoginService;
use App\User;
use Illuminate\Http\Request;

class LoginController extends ApiController
{

    protected $service;

    /**
     * LoginController constructor.
     * @param LoginService $service
     */
    public function __construct(LoginService $service){
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $fields = $request->only(User::API_FIELDS_LOGIN);
        $user = $this->service->loginUser($fields);
        if(!$user){
            $message = $this->service->checkEmail($fields[User::EMAIL]);
            return $this->sendError($message,401);
        }
        $token = $this->service->createToken($user, $request->get(User::REMEMBER_ME));
        return $this->sendSuccess(['token' => $token, 'user' => $user],'Вы успешно вошли в систему', 200);
    }
}
