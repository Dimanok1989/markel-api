<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Разрешения
     * 
     * @var array
     */
    protected $permissions = [
        ['id' => 1, 'permission' => "company_create", 'title' => "Может создавать компанию"],
        ['id' => 2, 'permission' => "company_edit", 'title' => "Может обновлять данные компании"],
        ['id' => 3, 'permission' => "company_delete", 'title' => "Может удалять компанию"],
        ['id' => 4, 'permission' => "company_access_owner", 'title' => "Имеет доступ к компаниям владельца"],
        ['id' => 5, 'permission' => "company_added_form", 'title' => "Может добавлять форму в компанию"],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            if (!Permission::find($permission['id'])) {
                Permission::create($permission);
            }
        }
    }
}
