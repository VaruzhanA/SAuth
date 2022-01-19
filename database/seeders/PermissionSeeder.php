<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class PermissionSeeder.
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Misc Permissions.
         */

        $permissions = [
            [
                'name' => 'view-backend',
                'display_name' => 'View Backend',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'view-frontend',
                'display_name' => 'View Frontend',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table(config('access.permissions_table'))->insert($permissions);
    }
}
