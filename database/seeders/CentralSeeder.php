<?php

namespace Database\Seeders;


use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CentralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'name' => 'Initial Domain',
            'domain' => 'initial.com',
            'database' => 'tenant_1',
        ]);
    }
}
