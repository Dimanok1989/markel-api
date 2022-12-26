<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegistrationRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Инициализация контроллера
     * 
     * @param  \App\Services\Users\UserService  $service
     * @return void
     */
    public function __construct(
        protected UserService $service
    ) {
    }

    /**
     * Выводит данные пользователя
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Users\UserResource
     */
    public function get(Request $request)
    {
        return new UserResource(
            $request->user()
        );
    }

    /**
     * Регистрация нового пользователя
     * 
     * @param  \App\Http\Requests\Users\RegistrationRequest  $request
     * @return \App\Http\Resources\Users\UserResource
     */
    public function registration(RegistrationRequest $request)
    {
        $data = $request->validated();

        return new UserResource(
            $this->service->registration($data)
        );
    }

    /**
     * Авторизация пользователя
     * 
     * @param  \App\Http\Requests\Users\LoginRequest  $request
     * @return \App\Http\Resources\Users\UserResource
     */
    public function login(LoginRequest $request)
    {
        return new UserResource(
            $this->service->login(
                $request->login,
                $request->password,
            )
        );
    }

    /**
     * Удаляет текущий токен
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Users\UserResource
     */
    public function logout(Request $request)
    {
        if (!$request->user())
            abort(403);

        return new UserResource(
            $this->service->logout(
                $request->user()
            ),
        );
    }
}
