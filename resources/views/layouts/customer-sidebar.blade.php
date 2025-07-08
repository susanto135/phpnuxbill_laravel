<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('customer.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="PHPNuxBill Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PHPNuxBill</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('customer.dashboard') }}" class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.tickets.index') }}" class="nav-link {{ request()->routeIs('customer.tickets.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-life-ring"></i>
                        <p>Support Tickets</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
