@extends ('backend.layouts.app')

@section ('title', 'Roles Management | Edit Role')

@section('page-header')
    <h1>
        Roles Management
        <small>Edit Role</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($role, ['route' => ['admin.role.update', $role], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        <div class="card-body">
                <div class="row form-group">
                    {{ Form::label('name', 'Role Name', ['class' => 'col-2 control-label']) }}

                    <div class="col-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.roles.name')]) }}
                    </div>
                </div><!--form control-->

                <div class="row form-group">
                    {{ Form::label('associated-permissions', 'Associated Permissions', ['class' => 'col-2 control-label']) }}

                    <div class="col-10">
                        @if ($role->id != 1)
                            {{-- Administrator has to be set to all --}}
                            {{ Form::select('associated-permissions', ['all' => 'All', 'custom' => 'Custom'], $role->all ? 'all' : 'custom', ['class' => 'form-control']) }}
                        @else
                            <span class="label label-success">All</span>
                        @endif

                        <div id="available-permissions" class="hidden mt-2">
                            <div class="row">
                                <div class="col-12">
                                    @if ($permissions->count())
                                        @foreach ($permissions as $perm)
                                            <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $rolePermissions) ? 'checked' : '') }} /> <label for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label><br/>
                                        @endforeach
                                    @else
                                        <p>There are no available permissions.</p>
                                    @endif
                                </div>
                            </div><!--row-->
                        </div><!--available permissions-->
                    </div>
                </div><!--form control-->

                <div class="row form-group">
                    {{ Form::label('sort', 'Sort', ['class' => 'col-2 control-label']) }}

                    <div class="col-10">
                        {{ Form::text('sort', null, ['class' => 'form-control', 'placeholder' => 'Role Sort']) }}
                    </div>
                </div><!--form control-->
            </div><!-- /.box-body -->
        </div><!--box-->

    <div class="card">
        <div class="card-body">
                <div class="float-left">
                    {{ link_to_route('admin.role.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="float-right">
                    {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection
