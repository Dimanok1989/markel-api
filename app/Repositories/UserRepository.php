<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Services\Phones\PhoneServiceInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Инициализация репозитория
     * 
     * @param  \App\Services\Phones\PhoneServiceInterface  $phone
     * @return void
     */
    public function __construct(
        protected PhoneServiceInterface $phones,
    ) {
    }

    /**
     * Поиск пользователя по логину
     * 
     * @param  string  $login
     * @return \App\Models\User|null
     */
    public function getByLogin(string $login)
    {
        if ($phone = $this->phones->getPhone($login)) {
            return $this->getByPhone($phone);
        } else if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return $this->getByEmail($login);
        }

        return null;
    }

    /**
     * Поиск пользователя по номеру телефона
     * 
     * @param  string  $phone
     * @return \App\Models\User|null
     */
    public function getByPhone(string $phone)
    {
        return User::wherePhone($phone)->first();
    }

    /**
     * Поиск пользователя по адресу электронной почты
     * 
     * @param  string  $email
     * @return \App\Models\User|null
     */
    public function getByEmail(string $email)
    {
        return User::whereEmail($email)->first();
    }
}
