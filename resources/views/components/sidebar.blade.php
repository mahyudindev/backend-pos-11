<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">POS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"></li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="{{ url('home') }}">
                    <i class="fas fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-user-friends"></i><span>Users</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.create') }}">Create User</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-box"></i><span>Products</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-list"></i> All
                            Product</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('products.create') }}"><i class="fas fa-plus"></i> Create
                            Product</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list"></i><span>Categories</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('categories.index') }}">All Category</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('categories.create') }}">Create Category</a>
                    </li>
                </ul>
            </li>

            <!-- New Sales item -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-chart-line"></i><span>Sales</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('sales.index') }}">All Sales</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('sales.create') }}">Create Sales</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
