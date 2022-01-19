<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class UserRoleSeeder.
 */
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Attach admin role to admin user
        $user_model = config('auth.providers.users.model');
        $user_model = new $user_model();
        $user_model::first()->attachRole(1);

    }
}
