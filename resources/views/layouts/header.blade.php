<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="bi-list"></i>
        </button>
        <ul class="header-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi-bell fs-5"></i>
                </a>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="https://gravatar.com/avatar/profile" alt="user@email.com">
                    </div>
                    <div class="d-none d-sm-inline ms-2">
                        <span class="fw-semibold">Andhika Dwi Khalisyahputra</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Account</div>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="bi-person me-2"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi-box-arrow-right me-2"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            @yield('breadcrumb')
        </nav>
    </div>
</header>
