<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="hidden-xs">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name  }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <a href="{{url('admin')}}" class="btn btn-default btn-flat m-2">
                    <i class="fa fa-home"></i>
                    Home
                </a>
                <a href="{!! route('logout') !!}" class="btn btn-danger btn-flat m-2 float-right">
                    <i class="fa fa-sign-out"></i>
                    LogOut
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
