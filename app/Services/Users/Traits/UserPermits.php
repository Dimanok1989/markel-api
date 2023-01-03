<?php

namespace App\Services\Users\Traits;

use Illuminate\Database\Eloquent\Model;

trait UserPermits
{
    /**
     * Проверенные разрешения
     * 
     * @var array
     */
    private $permits = [];

    /**
     * Загрузка разрешений
     * 
     * @param  array  $permits
     * @return \Illuminate\Support\Collection
     */
    public function getPermits(...$permits)
    {
        foreach ($permits as $permit) {
            if (!isset($this->permits[$permit])) {
                return $this->getUserPermissions(...$permits);
            }
        }

        return collect($this->permits);
    }

    /**
     * Загружает недостающие разрешения
     * 
     * @param  array  $permits
     * @return \Illuminate\Support\Collection
     */
    public function getUserPermissions(...$permits)
    {
        if ($this->is_admin) {
            foreach ($permits as $permit) {
                $this->permits[$permit] = true;
            }
        }

        foreach ($this->roles as $role) {

            $found = $this->getPermissionsFromEntity($role, $permits);

            foreach ($found as $permit) {
                $this->permits[$permit] = true;
            }
        }

        foreach ($this->getPermissionsFromEntity($this, $permits) as $permit) {
            $this->permits[$permit] = true;
        }

        foreach ($permits as $permit) {
            if (!isset($this->permits[$permit])) {
                $this->permits[$permit] = false;
            }
        }

        return collect($this->permits);
    }

    /**
     * Загружает разрешения пользователя или роли
     * 
     * @param  \Illuminate\Database\Eloquent\Model  $row
     * @param  array  $permissions
     * @return array<string>
     */
    public function getPermissionsFromEntity(Model $model, array $permissions)
    {
        return $model->permissions()->whereIn('permission', $permissions)
            ->whereNotIn('permission', array_keys($this->permits))
            ->get()
            ->map(function ($row) {
                return $row->permission;
            })
            ->toArray();
    }
}
