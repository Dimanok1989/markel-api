<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Роли
     * 
     * @var array
     */
    protected $roles = [
        ['id' => 1, 'role' => "owner", 'title' => "Владелец"],
        ['id' => 2, 'role' => "employee", 'title' => "Сотрудник"],
    ];

    /**
     * Стандартный набор разрешенеий для роли
     */
    protected $roles_permissions = [
        1 => [1, 2, 3, 4, 5, 6, 7, 8],
        2 => [4],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $data) {

            if (!$role = Role::find($data['id'])) {
                $role = Role::create($data);
            }

            if (isset($this->roles_permissions[$role->id])) {
                $role->permissions()->sync($this->roles_permissions[$role->id]);
            }
        }
    }
}
