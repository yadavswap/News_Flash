<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{'/'}}" class="brand-link">
        <img src="{{url('/images/websiteImage/'.\App\SiteDetail::first()->website_image)}}" alt="{{\App\SiteDetail::first()->title}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{\App\SiteDetail::first()->title}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/images/userImages/{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
            </div>
        </div>
        <br>
        <div class="row text-white">
            <div class="col-8"><span><b>{{ Auth::user()->name }}</b></span></div>
        </div>
        <br>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link {{ (Request::is('user.home') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/my-dashboard')}}" class="nav-link {{ (Request::is('my-dashboard') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/my-posts')}}"
                       class="nav-link {{ (request()->is('my-posts')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-clipboard-list nav-icon"></i>
                        <p>
                            My Posts
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/create-new-post')}}"
                       class="nav-link {{ (request()->is('create-new-post')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-plus-square nav-icon"></i>
                        <p>
                            Add Post
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
