<?php

namespace App\Services\Phones;

use App\Services\Phones\Exceptions\BadPhoneFormat;

class PhoneService implements PhoneServiceInterface
{
    /**
     * Проверяет является ли строка номером телефона
     * 
     * @param  array  $data
     * @param  array  $country
     * @return bool
     */
    public function isPhone(string $phone, string $country = "RU"): bool
    {
        return preg_match(
            '/\\d{10,11}/ism',
            preg_replace('/[^0-9]/', '', $phone)
        );
    }

    /**
     * Преобразует строку в номер телефона для базы данных
     * 
     * @param  string|int  $phone
     * @param  string  $country
     * @return string|null
     */
    public function getPhone(string|int $phone, string $country = "RU"): string|null
    {
        if (!$this->isPhone($phone, $country)) {
            return null;
        }

        return $this->getPhoneRu((string) $phone);
    }

    /**
     * Преобразует строку с российским номером телефона для базы данных
     */
    public function getPhoneRu(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) == 10)
            $phone = "7" . $phone;

        return "+7" . substr($phone, 1);
    }
}
