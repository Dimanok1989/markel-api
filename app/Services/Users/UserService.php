<?php

namespace App\Services\Users;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Инициализация сервиса
     * 
     * @param  \App\Repositories\Interfaces\UserRepositoryInterface  $repository
     * @return void
     */
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {
    }

    /**
     * Регистрация нового пользователя
     * 
     * @param  array  $data
     * @return \App\Models\User
     */
    public function registration(array $data)
    {
        $password = $data['password'] ?? Str::random(8);
        $data['password'] = Hash::make($password);

        $user = User::create($data)->refresh();

        $user->token = $this->createToken($user);

        return $user;
    }

    /**
     * Авторизация пользователя
     * 
     * @param  string  $login
     * @param  string  $password
     * @return \App\Models\User
     */
    public function login(string $login, string $password)
    {
        $user = $this->repository->getByLogin($login, $password);

        if (!$user or !Hash::check($password, $user->password))
            abort(401, "Неверный логин или пароль");

        $user->token = $this->createToken($user);

        return $user;
    }

    /**
     * Создает новый токен аутентификации
     * 
     * @param  \App\Models\User  $user
     * @param  null|string  $token_name
     * @return string
     */
    public function createToken(User $user, $token_name = null)
    {
        return $user->createToken($token_name ?: "{$user->id}" . time())->plainTextToken;
    }

    /**
     * Отзывает текущий токен
     * 
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();

        return $user;
    }
}
