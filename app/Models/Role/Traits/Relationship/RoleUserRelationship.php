<?php

namespace App\Models\Role\Traits\Relationship;

use App\Models\User\User;

/**
 * Class RoleUserRelationship.
 */
trait RoleUserRelationship
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }
}
