<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="nav-icon">
                <i class="bi bi-speedometer2"></i>
            </span> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('messages.index') ? 'active' : '' }}"
            href="{{ route('messages.index') }}">
            <span class="nav-icon">
                <i class="bi bi-chat-left-text"></i>
            </span> Message
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('letters.index') ? 'active' : '' }}"
            href="{{ route('letters.index') }}">
            <span class="nav-icon">
                <i class="bi bi-file-earmark"></i>
            </span> Letters
        </a>
    </li>
    @role('admin', 'lecturer')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('archives') ? 'active' : '' }}" href="{{ route('archives') }}">
                <span class="nav-icon">
                    <i class="bi bi-archive"></i>
                </span> Archives
            </a>
        </li>
    @endrole
    @role('admin')
        <li class="nav-title">ADMIN</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('messages.index') ? 'active' : '' }}"
                href="{{ route('messages.index') }}">
                <span class="nav-icon">
                    <i class="bi bi-clock-history left-text"></i>
                </span> Activities
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <span class="nav-icon">
                    <i class="bi bi-book"></i>
                </span> Academic
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('study_programs.index') ? 'active' : '' }}"
                        href="{{ route('study_programs.index') }}" target="_top">
                        <span class="nav-icon">
                            <i class="bi bi-mortarboard"></i>
                        </span> Study Programs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('classes.index') ? 'active' : '' }}"
                        href="{{ route('classes.index') }}" target="_top">
                        <span class="nav-icon">
                            <i class="bi bi-calendar"></i>
                        </span> Classes
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span> User Management
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lecturers') ? 'active' : '' }}"
                        href="{{ route('lecturers') }}" target="_top">
                        <span class="nav-icon">
                            <i class="bi bi-person"></i>
                        </span> Lecturers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('students') ? 'active' : '' }}"
                        href="{{ route('students') }}" target="_top">
                        <span class="nav-icon">
                            <i class="bi bi-person"></i>
                        </span> Students
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <span class="nav-icon">
                    <i class="bi bi-gear"></i>
                </span> Settings
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" target="_top">
                        <span class="nav-icon">
                            <i class="bi bi-gear"></i>
                        </span> General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reset') }}">
                        <span class="nav-icon">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </span> Reset
                    </a>
                </li>
            </ul>
        </li>
    @endrole
</ul>
