<header class="header header-sticky @role('student') px-lg-5 @endrole mb-4">
  <div class="container-fluid position-relative">
    @role('admin', 'lecturer')
      <button class="header-toggler px-md-0 me-md-3" type="button"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <i class="bi-list"></i>
      </button>
    @endrole
    @role('student')
      <button class="header-toggler px-md-0 me-md-3 d-lg-none" type="button"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <i class="bi-list"></i>
      </button>
      <img src="{{ asset('/images/CLEPify.png') }}" alt="CLEPify Logo" width="100" class="d-none d-sm-block me-auto">
      <ul class="header-nav d-none d-lg-flex position-absolute gap-2" style="left: 50%; transform: translate(-50%, 0);">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('letters.create') ? 'fw-bold' : '' }}"
            href="{{ route('letters.create') }}">
            Form
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('letters.index') ? 'fw-bold' : '' }}"
            href="{{ route('letters.index') }}">
            Status
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('messages') ? 'fw-bold' : '' }}" href="{{ route('messages') }}">
            Message
          </a>
        </li>
      </ul>
    @endrole
    <ul class="header-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi-bell-fill fs-5"></i>
        </a>
      </li>
      <li class="nav-item dropdown mt-1">
        <button class="btn btn-transparent" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
          <span class="fw-semibold ms-1">{{ Auth::user()->name }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <h6 class="dropdown-header bg-light">Account</h6>
          </li>
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
        </ul>
      </li>
    </ul>
  </div>
  @role('admin', 'lecturer')
    <div class="header-divider"></div>
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        @yield('breadcrumb')
      </nav>
    </div>
  @endrole
</header>
