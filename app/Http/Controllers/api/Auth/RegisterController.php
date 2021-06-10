<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\api\ApiController;
use App\Http\Requests\auth\RegisterBodyRequest;
use App\Http\Requests\Auth\RegisterBody;
use App\Http\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use App\User;


class RegisterController extends ApiController
{
    protected $service;

    /**
     * RegisterController constructor.
     * @param RegisterService $service
     */
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RegisterBodyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RegisterBodyRequest $request) : JsonResponse
    {
        $fields = $request->only(User::API_FIELDS_REGISTRATION);

        $user = $this->service->registerUser($fields);

        if($user){
           return $this->sendSuccess($user, 'Пользователь создан', 201);
        }
        return $this->sendError('Что-то пошло не так',520);

    }

}
