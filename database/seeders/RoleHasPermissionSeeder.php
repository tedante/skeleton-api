<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => '1',
                'role_id' => '1',
            ],
            [
                'permission_id' => '2',
                'role_id' => '1',
            ],
            [
                'permission_id' => '3',
                'role_id' => '1',
            ],
            [
                'permission_id' => '4',
                'role_id' => '1',
            ],
            [
                'permission_id' => '5',
                'role_id' => '1',
            ],
            [
                'permission_id' => '6',
                'role_id' => '1',
            ],
            [
                'permission_id' => '7',
                'role_id' => '1',
            ],
            [
                'permission_id' => '8',
                'role_id' => '1',
            ],
            [
                'permission_id' => '1',
                'role_id' => '2',
            ],
            [
                'permission_id' => '5',
                'role_id' => '2',
            ],
        ]);
    }
}
