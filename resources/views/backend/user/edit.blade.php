@extends ('backend.layouts.app')

@section ('title', 'User Management | Edit Role')

@section('page-header')
    <h1>
        User Management
        <small>Update User Role</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($user, [
            'id' => 'User_form',
            'route' => [
                'admin.user.update',
                $user
            ],
            'class'  => 'form-horizontal',
            'role'   => 'form',
            'method' => 'PATCH',
            'files'  => true,
        ])
    }}

    <div class="required_msg"></div>
    <div class="card">
        <div class="card-body">
            <div class="row form-group">
                <label class="col-2 control-label text-right">User Name</label>
                <div class="col-3">
                    <h4>{{$user->first_name.' '.$user->last_name}}</h4>
                </div>
            </div>

            <div class="row form-group">
                {{ Form::label('associated_roles', 'Associated Roles', ['class' => 'col-2 control-label text-right']) }}

                <div class="col-3">
                    @if (count($roles) > 0)
                        @foreach($roles as $role)
                            <input type="checkbox" value="{{$role->id}}" name="assignees_roles[{{ $role->id }}]"
                                   {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}"/>
                            <label for="role-{{$role->id}}">{{ $role->name }}</label>
                            <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                (
                                <span class="show-text">Show </span>
                                <span class="hide-text hidden">Hide </span>
                                Permissions
                                )
                            </a>
                            <br/>
                            <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                @if ($role->all)
                                    All Permissions<br/><br/>
                                @else
                                    @if (count($role->permissions) > 0)
                                        <blockquote class="small">{{--
                                            --}}@foreach ($role->permissions as $perm){{--
                                            --}}{{$perm->display_name}}<br/>
                                            @endforeach
                                        </blockquote>
                                    @else
                                        No Permission<br/><br/>
                                    @endif
                                @endif
                            </div><!--permission list-->
                        @endforeach
                    @else
                        No Roles
                    @endif
                </div><!--col-lg-3-->
            </div><!--form control-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="card">
        <div class="card-body">
            <div class="float-left">
                {{ link_to_route('admin.user.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="float-right">
                {{ Form::submit('Update Role', ['class' => 'btn btn-success btn-xs submit_button']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
    {{ Form::close() }}
@endsection
