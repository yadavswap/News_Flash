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
                <img src="{{url('/images/userImages/'.Auth::user()->avatar)}}" class="img-circle elevation-2" alt="Admin Image">
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
                    <a href="{{url('/admin/dashboard')}}" class="nav-link {{ (Request::is('home') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/categories')}}"
                       class="nav-link {{ (request()->is('categories')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/tags')}}"
                       class="nav-link {{ (request()->is('tags')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon far fa-list-alt nav-icon"></i>
                        <p>
                            Tags
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/posts')}}"
                       class="nav-link {{ (request()->is('posts')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-clipboard-list nav-icon"></i>
                        <p>
                            Posts
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/comments')}}"
                       class="nav-link {{ (request()->is('comments')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-comment nav-icon"></i>
                        <p>
                            Comments
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/users')}}"
                       class="nav-link {{ (request()->is('users')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-user-circle nav-icon"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/site-settings')}}"
                       class="nav-link {{ (request()->is('site-settings')) ? 'nav-link active' : '' }}">
                        <i class="nav-icon fa fa-cog nav-icon"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
