<?php

namespace Modules\User\Database\Seeders;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $admin = User::create([
            'name'        => 'Product Owner',
            'email'       => 'admin@example.com',
            'password'    => Hash::make('admin'),
            'is_employer' => true,
        ]);
        $admin->assignRole('admin');
    }
}
