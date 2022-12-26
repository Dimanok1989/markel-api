<?php

namespace App\Http\Services;

class Services
{
    /**
     * Проверяет является ли строка адресом электронной почты
     * 
     * @param  string  $email
     * @return bool
     */
    public function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
