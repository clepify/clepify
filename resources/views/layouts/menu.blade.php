<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="nav-icon">
                <i class="bi bi-speedometer2"></i>
            </span> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('letters') ? 'active' : '' }}" href="{{ route('letters') }}">
            <span class="nav-icon">
                <i class="bi bi-file-earmark"></i>
            </span> Letters
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('archives') ? 'active' : '' }}" href="{{ route('archives') }}">
            <span class="nav-icon">
                <i class="bi bi-archive"></i>
            </span> Archives
        </a>
    </li>
    <li class="nav-title">ADMIN</li>
    <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
            <span class="nav-icon">
                <i class="bi bi-people"></i>
            </span> User Management
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="login.html" target="_top">
                    <span class="nav-icon">
                        <i class="bi bi-person"></i>
                    </span> Lecturers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.html" target="_top">
                    <span class="nav-icon">
                        <i class="bi bi-person"></i>
                    </span> Students
                </a>
            </li>
        </ul>
    </li>
</ul>
