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
        ['permission' => "company_create", 'title' => "Может создавать компанию"],
        ['permission' => "company_edit", 'title' => "Может обновлять данные компании"],
        ['permission' => "company_delete", 'title' => "Может удалять компанию"],
        ['permission' => "company_access_owner", 'title' => "Имеет доступ к компаниям владельца"],
        ['permission' => "company_form_create", 'title' => "Может добавлять форму в компанию"],
        ['permission' => "company_form_edit", 'title' => "Может изменять данные формы компании"],
        ['permission' => "company_form_delete", 'title' => "Может удалять форму компании"],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $key => $permission) {
            
            $permission_id = $key + 1;

            if (!Permission::find($permission_id)) {
                Permission::create([
                    'id' => $permission_id,
                    ...$permission
                ]);
            }
        }
    }
}
