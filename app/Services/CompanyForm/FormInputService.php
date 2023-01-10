<?php

namespace App\Services\CompanyForm;

use App\Models\CompanyFormInput;
use App\Services\Interfaces\FormInputInterface;

class FormInputService implements FormInputInterface
{
    /**
     * Создает новое поле ввода
     * 
     * @param  array  $data
     * @return \App\Models\CompanyFormInput
     */
    public function create(array $data)
    {
        return CompanyFormInput::create($data)->refresh();
    }

    /**
     * Обновление данных поля ввода
     * 
     * @param  \App\Models\CompanyFormInput  $input
     * @param  array  $data
     * @return \App\Models\CompanyFormInput
     */
    public function update(CompanyFormInput $input, array $data)
    {
        $input->update($data);

        return $input;
    }

    /**
     * Удаляет поле ввода
     * 
     * @param  \App\Models\CompanyFormInput  $input
     * @return \App\Models\CompanyFormInput
     */
    public function delete(CompanyFormInput $input)
    {
        $input->delete();

        return $input;
    }
}
