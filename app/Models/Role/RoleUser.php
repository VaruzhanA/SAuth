<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role\Traits\Relationship\RoleUserRelationship;

/**
 * Class RoleUser.
 */
class RoleUser extends Model
{
    use RoleUserRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id', 'role_id'];
}
