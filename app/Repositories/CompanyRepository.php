<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * Выводит компании пользователя
     * 
     * @param  int|null  $user_id
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list($user_id = null)
    {
        return Company::orderBy('created_at', "DESC")
            ->when(!is_null($user_id), fn ($query) => $query->whereUserId($user_id))
            ->paginate(5);
    }

    /**
     * Получает данные компании
     * 
     * @param  int  $id
     * @return \App\Models\Company|null
     */
    public function getById($id)
    {
        return Company::find($id);
    }
}
