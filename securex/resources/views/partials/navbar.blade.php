<nav class="navbar fixed-top align-items-start navbar-expand-lg pl-0 pr-0 py-0" >

    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand mr-0" href="../../" target="_top">
            <img src="{{ url('assets/img/vanguard-logo.png') }}" height="35" alt="{{ settings('app_name') }}">
        </a>
    </div>

    <div>
        <button class="navbar-toggler" type="button" id="sidebar-toggle">
            <i class="fas fa-align-right text-muted"></i>
        </button>

        <button class="navbar-toggler mr-3"
                type="button"
                data-toggle="collapse"
                data-target="#top-navigation"
                aria-controls="top-navigation"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars text-muted"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="top-navigation">
        <div class="row ml-2">
            <div class="col-lg-12 d-flex align-items-center py-3">
                <h4 class="page-header mb-0">
                    @yield('page-heading')
                </h4>

                <ol class="breadcrumb mb-0 font-weight-light">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-muted">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>

                    @yield('breadcrumbs')
                </ol>
            </div>
        </div>

        <ul class="navbar-nav ml-auto pr-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <img src="{{ auth()->user()->present()->avatar }}"
                         width="50"
                         height="50"
                         class="rounded-circle img-thumbnail img-responsive">
                </a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fas fa-user text-muted mr-2"></i>
                        @lang('app.my_profile')
                    </a>
                    @if (config('session.driver') == 'database')
                        <a href="{{ route('profile.sessions') }}" class="dropdown-item">
                            <i class="fas fa-list text-muted mr-2"></i>
                            @lang('app.active_sessions')
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        @lang('app.logout')
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar-brand-wrapper {
        background-color:#ccc5b1;
        border: 1px solid #b3ac98;
        background-image: -o-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -moz-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -webkit-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -ms-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: linear-gradient(to bottom, #e5deca 0%, #ccc5b1 100%);
        -webkit-box-shadow: inset 0 1px 0 #fef7e3;
        -moz-box-shadow: inset 0 1px 0 #fef7e3;
        box-shadow: inset 0 1px 0 #fef7e3;
    }
    .navbar-collapse {
        background-color:#ccc5b1;
        border: 1px solid #e8e1cc;
        background-image: -o-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -moz-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -webkit-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -ms-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: linear-gradient(to bottom, #e5deca 0%, #ccc5b1 100%);
        -webkit-box-shadow: inset 0 1px 0 #fef7e3;
        -moz-box-shadow: inset 0 1px 0 #fef7e3;
        box-shadow: inset 0 1px 0 #fef7e3;
    }
    .text-muted {
        color: #0d3e21!important;
    }
    .breadcrumb-item.active {
        color: #0d3e21;
    }
    .navbar .page-header {
        border-right: 1px solid #1f3309;
    }
</style>