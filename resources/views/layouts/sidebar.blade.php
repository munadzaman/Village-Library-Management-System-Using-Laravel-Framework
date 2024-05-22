<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon r">
            <i class="fa fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Rural Library</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    @if(Auth::check() && Auth::user()->role === 'supervisor')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>
    @endif

    <!-- Members List Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('members.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Members List</span>
        </a>
    </li>

    <!-- Books List Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('books.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Books List</span>
        </a>
    </li>

    <!-- Borrowing Records Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('borrowing_records.index') }}">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Borrowing Records</span>
        </a>
    </li>

    <!-- Add Borrowing Record Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('borrowing_records.create') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Add Borrowing Record</span>
        </a>
    </li>

    <!-- Add Book Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('books.create') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Add Book</span>
        </a>
    </li>

    <!-- Add Member Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('members.create') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Add Member</span>
        </a>
    </li>
    
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
