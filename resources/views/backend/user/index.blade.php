@extends ('backend.layouts.app')

@section ('title', 'Users Management')

@section('page-header')
    <h1>
        Users Management
        <small>Active Users</small>
    </h1>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_table" class="table table-bordered table-condensed table-hover"
                                   data-url="{{route('admin.user.table')}}">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>User Type</th>
                                    <th>Roles</th>
                                    <th>Last Login</th>
                                    <th>Signup Date</th>
                                    <th>Signup Source</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
