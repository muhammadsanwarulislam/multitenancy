<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     */
    public function run()
    {
        if ($_SERVER['argv'][1] != "tenants:migrate") {
            return $this->call([CentralSeeder::class]);
        }else {
            $this->call([
                RoleSeeder::class,
                PermissionSeeder::class,
                UserSeeder::class,
                RolePermissionSeeder::class,
            ]);
        }
    }
}
