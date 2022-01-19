<?php

namespace App\Repositories\Auth;

use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Role\RoleRepository;
use App\Models\User\Traits\DeviceDetectTrait;


/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    use DeviceDetectTrait;

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
     * @param array $data
     * @param bool  $provider
     *
     * @return static
     */
    public function create(array $data)
    {
        $device_type = $this->getDevice();

        $user = self::MODEL;
        $user = new $user;
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->status = 1;
        $user->type = $data['contact-type'];
        $user->signup_source = $device_type;
        $user->password = bcrypt($data['password']);

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                /*
                 * Add the default site role to the new user
                 */
                $user->attachRole($this->role->getDefaultUserRole());
            }
        });

        /*
         * If users have to confirm their email and this is not a social account,
         * send the confirmation email
         */
//            $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        /*
         * Return the user object
         */
        return $user;
    }

}
