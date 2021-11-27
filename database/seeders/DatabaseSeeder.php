<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\AuthDatabaseSeeder;
use Modules\User\Database\Seeders\RolesSeederTableSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeederTableSeeder::class);
        $this->call(UserDatabaseSeeder::class);
    }
}
