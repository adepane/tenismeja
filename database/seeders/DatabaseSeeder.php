<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = [
            ['id' => '1', 'name' => 'Super Administrator', 'role_access' => '{}', 'status' => true, 'created_at' => Carbon::now()],
            ['id' => '2', 'name' => 'Management', 'role_access' => '{}', 'status' => true, 'created_at' => Carbon::now()],
            ['id' => '3', 'name' => 'Operator', 'role_access' => '{}', 'status' => true, 'created_at' => Carbon::now()],
            ['id' => '4', 'name' => 'Agencies', 'role_access' => '{}', 'status' => true, 'created_at' => Carbon::now()],
            ['id' => '5', 'name' => 'User', 'role_access' => '{}', 'status' => true, 'created_at' => Carbon::now()],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
