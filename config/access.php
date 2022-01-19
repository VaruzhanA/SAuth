<?php

use App\Models\User\User;
use App\Models\Role\Role;
use App\Models\Permission\Permission;

return [
    /*
     * Users table used to store users
     */
    'users_table' => 'users',

    /*
   * User model used by Access to create correct relations. Update the user if it is in a different namespace.
  */
    'user' => User::class,

    /*
     * Role model used by Access to create correct relations. Update the role if it is in a different namespace.
    */
    'role' => Role::class,

    /*
     * Roles table used by Access to save roles to the database.
     */
    'roles_table' => 'roles',

    /*
     * users_role table used by Access to save assigned roles to the database.
     */
    'users_role_table' => 'users_role',

     /*
     * Permission model used by Access to create correct relations.
     * Update the permission if it is in a different namespace.
     */
    'permission' => Permission::class,

    /*
     * Permissions table used by Access to save permissions to the database.
     */
    'permissions_table' => 'permissions',

    /*
     * permission_role table used by Access to save relationship between permissions and roles to the database.
     */
    'permission_role_table' => 'permission_role',

    /*
     * Configurations for the user
     */
    'users' => [
        /*
         * The role the user is assigned to when they sign up from the frontend, not namespaced
         */
        'default_role' => 'User',
    ],

    /*
     * Configuration for roles
     */
    'roles' => [
        /*
         * Whether a role must contain a permission or can be used standalone as a label
         */
        'role_must_contain_permission' => true,
    ],

];
