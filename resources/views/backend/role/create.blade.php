@extends ('backend.layouts.app')

@section ('title', 'Role Management | Create Role')

@section('page-header')
    <h1>
        Role Management
        <small>Create Role</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create_role']) }}

    <div class="card">
        <div class="card-body">
            <div class="row form-group">
                {{ Form::label('name', 'Role Name', ['class' => 'col-2 control-label']) }}

                <div class="col-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Role Name']) }}
                </div><!--col-10-->
            </div><!--form control-->

            <div class="row form-group">
                {{ Form::label('associated-permissions', 'Associated Permissions', ['class' => 'col-2 control-label']) }}

                <div class="col-10">
                    {{ Form::select('associated-permissions', array('all' => 'All', 'custom' => 'Custom'), 'all', ['class' => 'form-control']) }}

                    <div id="available-permissions" class="hidden mt-2">
                        <div class="row">
                            <div class="col-12">
                                @if ($permissions->count())
                                    @foreach ($permissions as $perm)
                                        <input type="checkbox" name="permissions[{{ $perm->id }}]"
                                               value="{{ $perm->id }}"
                                               id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }} />
                                        <label for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label><br/>
                                    @endforeach
                                @else
                                    <p>There are no available permissions.</p>
                                @endif
                            </div>
                        </div><!--row-->
                    </div><!--available permissions-->
                </div><!--col-3-->
            </div><!--form control-->

            <div class="row form-group">
                {{ Form::label('sort', 'Sort', ['class' => 'col-2 control-label']) }}

                <div class="col-10">
                    {{ Form::text('sort', ($roleCount+1), ['class' => 'form-control', 'placeholder' => 'Sort']) }}
                </div><!--col-10-->
            </div><!--form control-->
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="float-left">
                {{ link_to_route('admin.role.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="float-right">
                {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div>
    </div>

    {{ Form::close() }}
@endsection
