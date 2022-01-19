<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role\Role;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Assign view backend to executive role as example
         */
        Role::find(1)->permissions()->sync([1]);
    }
}
