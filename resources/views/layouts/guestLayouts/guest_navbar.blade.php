<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{'/'}}" class="navbar-brand">
            <img src="{{url('/images/websiteImage/'.\App\SiteDetail::first()->website_image)}}" alt="{{\App\SiteDetail::first()->title}}"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{\App\SiteDetail::first()->title}}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{'/'}}" class="nav-link">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{'/my-dashboard'}}" class="nav-link">Dashboard</a>
                    </li>
                    <!-- Right navbar links -->
                    <a class="nav-link" href="{{url('/logout')}}">Logout</a>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{'/login'}}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{'/register'}}" class="nav-link">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>