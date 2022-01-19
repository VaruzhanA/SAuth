<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Class UserSeeder.
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Misc Users.
         */

        $user = [
            'first_name' => 'Admin',
            'last_name' => 'Istrator',
            'email' => 'admin@admin.com',
            'type' => 2,
            'status' => 1,
            'password' => Hash::make('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        DB::table(config('access.users_table'))->insert($user);
    }
}
