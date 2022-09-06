<!-- ========== Header Start ========== -->

<div class="topbar">

    <!-- Logo -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{ action('HomeController@welcome') }}" class="logo">
                <i class="icon-c-logo"> <img src="{{ asset('images/icon.png') }}" height="35"/> </i>
                <span><img src="{{ asset('images/icon.png') }}" height="40"/></span>
            </a>
        </div>
    </div>

    <!-- Top Menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">

                <!-- Collapse sidebar menu -->
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">

                    <!-- User -->
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown"
                           aria-expanded="true"><img src="{{ asset('images/user-placeholder.png') }}" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ action('UserController@edit', Auth::id()) }}"><i class="ti-user m-r-10 text-custom"></i> My Account</a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i> Logout {{ Auth::user()->name }}</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<!-- ========== Header End ========== -->