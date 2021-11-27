<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\User\Enums\Permissions;
use Modules\User\Enums\Roles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        array_map(
            function ($item) {
                return Role::create(['name' => $item, 'guard_name' => 'api']);
            },
            Roles::values()
        );

        array_map(
            function ($item) {
                return Permission::create(['name' => $item, 'guard_name' => 'api']);
            },
            Permissions::values()
        );
    }
}
