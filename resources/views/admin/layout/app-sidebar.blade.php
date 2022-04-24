<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion text-uppercase toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" target="_blank" href="{{ route('home') }}">
            <i class="fas fa-home"></i>
            <span>Đến trang web</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/categories') ? ' sidebar-link-active' : '' }}"
            href="{{ route('admin.categories.index') }}">
            <i class="fas fa-blog{{ request()->is('admin/categories') ? ' sidebar-link-active' : '' }}"></i>
            <span>Thể loại</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/categories/create') ? ' sidebar-link-active' : '' }}"
            href="{{ route('admin.categories.create') }}">
            <i class="far fa-plus-square{{ request()->is('admin/categories/create') ? ' sidebar-link-active' : '' }}"></i>
            <span>Thêm thể loại</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/posts') ? ' sidebar-link-active' : '' }}"
            href="{{ route('admin.posts.index') }}">
            <i class="fas fa-blog{{ request()->is('admin/posts') ? ' sidebar-link-active' : '' }}"></i>
            <span>Bài đăng</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/posts/create') ? ' sidebar-link-active' : '' }}"
            href="{{ route('admin.posts.create') }}">
            <i class="far fa-plus-square{{ request()->is('admin/posts/create') ? ' sidebar-link-active' : '' }}"></i>
            <span>Thêm bài đăng</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tài khoản
    </div>

    <li class="nav-item">
        <a class="nav-link{{ request()->is('admin/profile') ? ' sidebar-link-active' : '' }}"
            href="{{ route('admin.profile') }}">
            <i class="fas fa-user{{ request()->is('admin/profile') ? ' sidebar-link-active' : '' }}"></i>
            <span>Thông tin cá nhân</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Đăng xuất</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
