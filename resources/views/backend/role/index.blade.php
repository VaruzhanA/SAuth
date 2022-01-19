@extends ('backend.layouts.app')

@section ('title', 'Role Management')


@section('page-header')
    <h1>Role Management</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-right mb-3">
                        {{ link_to_route('admin.role.index', 'All Roles', [], ['class' => 'btn btn-primary btn-xs']) }}
                        {{ link_to_route('admin.role.create', 'Create Role', [], ['class' => 'btn btn-success btn-xs']) }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="roles_table" class="table table-bordered table-condensed table-hover"
                               data-url="{{ route("admin.role.table") }}">
                            <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Number of Users</th>
                                <th>Sort</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
