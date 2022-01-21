<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin/')}}" class="brand-link">
        <img src="{{asset('assets/images/sauth-logo.jpg')}}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">SAuth</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @role(1)
                <li class="nav-item">
                    <a href="{{url('/admin')}}" class="nav-link {{\Route::currentRouteName() == 'admin.dashboard'?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{\Route::currentRouteName() == 'admin.user.index'?'active':''}}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link {{\Route::currentRouteName() == 'admin.role.index'?'active':''}}">
                        <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                        <p>
                            Roles Management
                        </p>
                    </a>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
