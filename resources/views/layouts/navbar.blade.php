<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Navbar - Left Side -->
    <ul class="navbar-nav mr-auto">
        <!-- Empty li for spacing -->
    </ul>

    <!-- Navbar - Centered Title -->
    <div class="mx-auto">
        <span class="navbar-brand mb-0 h1" style="font-family: 'Arial Black', Gadget, sans-serif; font-size: 24px; padding-right: 20px;">Village Library Management System</span>
    </div>

    <!-- Navbar - Right Side -->
    <ul class="navbar-nav ml-auto">

        <!-- Authentication Links -->
        @if(Auth::check())
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name }}
                        <br>
                        <small>{{ Auth::user()->role }}</small>
                    </span>
                    <img class="img-profile rounded-circle" src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endif

    </ul>
</nav>
