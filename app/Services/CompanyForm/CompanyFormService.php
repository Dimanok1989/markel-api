<?php

namespace App\Services\CompanyForm;

use App\Models\CompanyForm;
use App\Services\Interfaces\CompanyFormInterface;

class CompanyFormService implements CompanyFormInterface
{
    /**
     * Создает новую форму клмпании
     * 
     * @param  array  $data
     * @return \App\Models\CompanyForm
     */
    public function create(array $data)
    {
        return CompanyForm::create($data)->refresh();
    }

    /**
     * Обновляет основные данные формы
     * 
     * @param  \App\Models\CompanyForm  $form
     * @param  array  $data
     * @return \App\Models\CompanyForm
     */
    public function update(CompanyForm $form, array $data)
    {
        $form->update($data);

        return $form;
    }

    /**
     * Удаяет форму
     * 
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Models\CompanyForm
     */
    public function destroy(CompanyForm $form)
    {
        $form->delete();

        return $form;
    }
}
