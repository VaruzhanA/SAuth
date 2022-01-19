<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role\Traits\RoleAccess;
use App\Models\Role\Traits\Attribute\RoleAttribute;
use App\Models\Role\Traits\Relationship\RoleRelationship;

/**
 * Class Role.
 */
class Role extends Model
{
    use RoleAccess,
        RoleAttribute,
        RoleRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'all', 'sort'];

}
