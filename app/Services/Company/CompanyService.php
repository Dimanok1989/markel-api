<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Services\Interfaces\CompanyInterface;

class CompanyService implements CompanyInterface
{
    /**
     * Инициализация сервиса
     * 
     * @param  \App\Repositories\Interfaces\CompanyRepositoryInterface  $repository
     * @return void
     */
    public function __construct(
        protected CompanyRepositoryInterface $repository
    ) {
    }

    /**
     * Выводит компании пользователя
     * 
     * @param  int  $user_id
     */
    public function list(int $user_id)
    {
        return $this->repository->list($user_id);
    }

    /**
     * Создает новую клмпанию
     * 
     * @param  array  $data
     * @return \App\Models\Company
     */
    public function create(array $data)
    {
        return Company::create($data)->refresh();
    }

    /**
     * Обновленяет данные компании
     * 
     * @param  \App\Models\Company  $company
     * @param  array  $data
     * @return \App\Models\Comany
     */
    public function update(Company $company, array $data)
    {
        $company->update($data);

        return $company;
    }

    /**
     * Удаляет компанию
     * 
     * @param  \App\Models\Company  $company
     * @return \App\Models\Comany
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return $company;
    }
}
