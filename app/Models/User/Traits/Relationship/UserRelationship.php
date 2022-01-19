<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\Role\Role;
use App\Models\System\Session;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, config('access.users_role_table'), 'users_id', 'role_id');
    }

}
