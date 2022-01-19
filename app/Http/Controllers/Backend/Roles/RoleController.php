<?php

namespace App\Http\Controllers\Backend\Roles;

use App\Models\Role\Role;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Role\RoleRepository;
use App\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Repositories\Backend\Permission\PermissionRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * @param RoleRepository       $roles
     * @param PermissionRepository $permissions
     */
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.role.index');
    }

    /**
     * @return mixed
     */
    public function table()
    {
        return Datatables::of($this->roles->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->addColumn('permissions', function ($role) {
                if ($role->all) {
                    return '<span class="alert alert-success p-1">All</span>';
                }

                return $role->permissions->count() ?
                    implode('<br/>', $role->permissions->pluck('display_name')->toArray()) :
                    '<span class="alert alert-danger p-1">None</span>';
            })
            ->addColumn('users', function ($role) {
                return $role->users->count();
            })
            ->addColumn('actions', function ($roles) {
                return $roles->action_buttons;
            })
            ->make(true);
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create(ManageRoleRequest $request)
    {
        return view('backend.role.create')
            ->withPermissions($this->permissions->getAll())
            ->withRoleCount($this->roles->getCount());
    }

    /**
     * @param StoreRoleRequest $request
     *
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->only('name', 'associated-permissions', 'permissions', 'sort'));

        return redirect()->route('admin.role.index')->withFlashSuccess(trans('alerts.backend.roles.created'));
    }

    /**
     * @param Role              $role
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function edit(Role $role, ManageRoleRequest $request)
    {
        return view('backend.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAll());
    }

    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     *
     * @return mixed
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role, $request->only('name', 'associated-permissions', 'permissions', 'sort'));

        return redirect()->route('admin.role.index')->withFlashSuccess('Role updated');
    }

    /**
     * @param Role              $role
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function destroy(Role $role, ManageRoleRequest $request)
    {
        $this->roles->delete($role);

        return redirect()->route('admin.role.index')->withFlashSuccess('Role Deleted');
    }
}
