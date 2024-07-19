<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-text mx-3">
            <img src="{{ asset('vendor/img/blogslogo.png') }}" alt="Blogs Logo" style="max-height: 150px;">
        </div>
    </a>
    @php
    // $permissions = request()->rolePermissions ?? [];
    // $permissions = request()->userPermissions ?? [];
    //without repeat variable, we use it at every request.
    dd($permissions,in_array('Blogs Listing', $permissions));
    @endphp
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if (in_array('User Listing', $permissions))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/user') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span>
            </a>
        </li>
    @endif
    @if (in_array('Category Listing', $permissions))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/category') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Categories</span>
            </a>
        </li>
    @endif
    @if (in_array('Blogs Listing', $permissions))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/blog') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Blogs</span>
            </a>
        </li>
    @endif
    @if (in_array('Roles Listing', $permissions))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/role') }}">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Roles</span>
            </a>
        </li>
    @endif
    @if (in_array('Permissions Listing', $permissions))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/permission') }}">
                <i class="fas fa-fw fa-lock"></i>
                <span>Permissions</span>
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="fas fa-fw fa-power-off"></i>
            {{ __('Logout') }}
            <i class="fas fa-fw fa-sign-out"></i>

        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
