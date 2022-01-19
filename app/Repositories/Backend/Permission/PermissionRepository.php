<?php

namespace App\Repositories\Backend\Permission;

use App\Repositories\BaseRepository;
use App\Models\Permission\Permission;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;
}
