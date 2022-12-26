<?php

namespace App\Services\Phones;

interface PhoneServiceInterface
{
    /**
     * Проверяет является ли строка номером телефона
     * 
     * @param  array  $data
     * @param  array  $country
     * @return bool
     */
    public function isPhone(string $phone, string $country = "RU"): bool;

    /**
     * Преобразует строку в номер телефона для базы данных
     * 
     * @param  string|int  $phone
     * @param  string  $country
     * @return string|null
     */
    public function getPhone(string|int $phone, string $country = "RU"): string|null;
}
