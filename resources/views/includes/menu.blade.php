<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
        <div class="profile-image">                  
            <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
            <p class="profile-name">{{ Auth::user()->name }}</p>
        </div>
        
        </a>
    </li>
    <li class="nav-item nav-category">
        <span class="nav-link">Dashboard</span>
    </li>
    @if(Auth::user()->level == 0)
    <li class="nav-item">
        <a class="nav-link" href="{{ route("home.admin.index") }}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-screen-desktop menu-icon"></i>
        </a>
    </li>
    <li class="nav-item nav-category"><span class="nav-link">AKTIVITAS</span></li>
    <li class="nav-item">
        <a class="nav-link"  href="{{ route('home.adminnew.account') }}">
        <span class="menu-title">New Account</span>
        <i class="icon-layers menu-icon"></i>
        </a>
        
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('home.admin.data.semester')}}">
        <span class="menu-title">Data Semester</span>
        <i class="icon-grid menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route("home.admin.perangkat.pembelajaran") }}">
        <span class="menu-title">Perangkat Pemb.</span>
        <i class="icon-book-open menu-icon"></i>
        </a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{ route("home") }}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-screen-desktop menu-icon"></i>
        </a>
    </li>
    <li class="nav-item nav-category"><span class="nav-link">AKTIVITAS</span></li>
    <li class="nav-item">
        <a class="nav-link"  href="{{ route('home.matakuliah.index') }}">
        <span class="menu-title">Matakuliah</span>
        <i class="icon-layers menu-icon"></i>
        </a>
        
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('home.perangkat.index')}}">
        <span class="menu-title">Perangkat Perkuliahan</span>
        <i class="icon-grid menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
        <span class="menu-title">Disukusi</span>
        <i class="icon-book-open menu-icon"></i>
        </a>
    </li>
    @endif
    </ul>
</nav>
