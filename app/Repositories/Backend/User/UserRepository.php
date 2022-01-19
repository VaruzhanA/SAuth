<?php

namespace App\Repositories\Backend\User;

use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Role\RoleRepository;;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        $dataTableQuery = $this->query()
            ->with('roles')
            ->select([
                config('access.users_table') . '.id',
                'first_name',
                'last_name',
                'email',
                'status',
                'type',
                'last_login',
                'signup_source',
                'created_at',
            ]);

        return $dataTableQuery;
    }

    /**
     * @param $roles
     * @param $user
     */
    public function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles->toArray());
        $user->attachRoles($roles);
    }


    /**
     * @param Model $user
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark(Model $user, $status)
    {
        if (app('access')->id() == $user->id && $status == 1) {
            throw new GeneralException('You can not do that to yourself.');
        }

        $user->status = $status;

        if ($user->save()) {
            return true;
        }

        throw new GeneralException('There was a problem updating this user. Please try again.');
    }

    /**
     * Remove old session variables from admin logging in as user.
     */
    public function flushTempSession()
    {
        // Remove any old session variables
        session()->forget('admin_user_id');
        session()->forget('admin_user_name');
        session()->forget('temp_user_id');
    }
}
