<?php

namespace App\Http\Controllers\Backend\Users;

use App\Models\User\User;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\User\UserRepository;
use App\Repositories\Backend\Role\RoleRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Backend\User\UpdateUserRequest;

/**
 * Class UserController.
 */
class UserController extends Controller {

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @param UserRepository $users
     * @param RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles) {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('backend.user.index');
    }

    /**
     * @return mixed
     */
    public function table()
    {
        return Datatables::of($this->users->getForDataTable())
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->addColumn('roles', function ($user) {
                return $user->roles->count() ?
                    implode(', ', $user->roles->pluck('name')->toArray()) :'None';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function edit(User $user) {
        return view('backend.user.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    /**
     * @param User  $user
     * @param UpdateUserRequest $request
     *
     * @return mixed
     */
    public function update(User $user, UpdateUserRequest $request) {
        $assigneesRoles =  $request->assignees_roles ?? [];

        $this->users->flushRoles($assigneesRoles, $user);

        return redirect()->route('admin.user.index')->withFlashSuccess('User role updated.');
    }

    /**
     * @param User $user
     * @param $status
     *
     * @return mixed
     */
    public function mark(User $user, $status)
    {
        $this->users->mark($user, $status);

        $success_message = $status == 1 ? 'User Status Activated': 'User Status Deactivated';

        return redirect()->route('admin.user.index' )->withFlashSuccess($success_message);
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs(User $user)
    {
        // Overwrite who we're logging in as, if we're already logged in as someone else.
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Let's not try to login as ourselves.
            if (app('access')->id() == $user->id || session()->get('admin_user_id') == $user->id) {
                throw new GeneralException('Do not try to login as yourself.');
            }

            // Overwrite temp user ID.
            session(['temp_user_id' => $user->id]);

            // Login.
            app('access')->loginUsingId($user->id);

            // Redirect.
            return redirect()->route('home');
        }

        $this->users->flushTempSession();

        // Won't break, but don't let them "Login As" themselves
        if (app('access')->id() == $user->id) {
            throw new GeneralException('Do not try to login as yourself.');
        }

        // Add new session variables
        session(['admin_user_id' => app('access')->id()]);
        session(['admin_user_name' => app('access')->user()->name]);
        session(['temp_user_id' => $user->id]);

        // Login user
        app('access')->loginUsingId($user->id);

        // Redirect to frontend
        return redirect()->route('home');
    }


}
