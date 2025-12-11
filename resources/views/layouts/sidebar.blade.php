<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ url('/dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/lanmiclogo.png') }}" alt="Lanmic Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Lanmic</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="navigation" aria-label="Main navigation">

                <!-- System Access -->
                <li class="nav-item permissions-menu {{ request()->routeIs('permissions.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link permissions-toggle {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        <i
                            class="nav-icon bi bi-gear-fill {{ request()->routeIs('permissions.*') ? 'text-primary' : 'text-muted' }}"></i>
                        <p>
                            System Access
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- User Levels -->

                        @if (Auth::user()->hasPermission('View Permission Type') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('permissions.type') }}"
                                    class="nav-link {{ request()->routeIs('permissions.type') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('permissions.type') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Permission Type</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasPermission('View Permission Settings') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('permissions.view') }}"
                                    class="nav-link {{ request()->routeIs('permissions.view') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('permissions.view') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Permission Settings</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <!-- Master Files -->
                <li class="nav-item masterfiles-menu {{ request()->routeIs('Masterfile.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link masterfiles-toggle {{ request()->routeIs('Masterfile.*') ? 'active' : '' }}">
                        <i
                            class="nav-icon bi bi-folder-fill {{ request()->routeIs('Masterfile.*') ? 'text-primary' : 'text-muted' }}"></i>
                        <p>
                            Master Files
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- User Levels -->
                        @if (Auth::user()->hasPermission('view userlevel master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.userlevel') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.userlevel') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.userlevel') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>User Levels</p>
                                </a>
                            </li>
                        @endif
                        <!-- Users -->
                        @if (Auth::user()->hasPermission('view user master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.users') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.users') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.users') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endif

                        <!-- Centers -->
                        @if (Auth::user()->hasPermission('view center master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.centers') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.centers') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.centers') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Centers</p>
                                </a>
                            </li>
                        @endif
                        <!-- Vehicles -->
                        @if (Auth::user()->hasPermission('view vehicle master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.vehicles') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.vehicles') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.vehicles') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Vehicles</p>
                                </a>
                            </li>
                        @endif
                        <!-- Drivers -->
                        @if (Auth::user()->hasPermission('view driver master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.drivers') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.drivers') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.drivers') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Drivers</p>
                                </a>
                            </li>
                        @endif
                        <!-- Helpers -->
                        @if (Auth::user()->hasPermission('view helper master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.helpers') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.helpers') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.helpers') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Helpers</p>
                                </a>
                            </li>
                        @endif
                        <!-- Security -->
                        @if (Auth::user()->hasPermission('view security master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.securities') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.securities') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.securities') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Security</p>
                                </a>
                            </li>
                        @endif
                        <!-- Incentive -->
                        @if (Auth::user()->hasPermission('view payment master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.incentive') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.incentive') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.incentive') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Payments</p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermission('view customer master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.customers') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.customers') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.customers') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Customers</p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermission('view otherpayments master') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('Masterfile.otherpayments') }}"
                                    class="nav-link {{ request()->routeIs('Masterfile.otherpayments') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.otherpayments') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Other Payments</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </li>

                <!-- Outward (New) -->
                <li class="nav-item outward-menu {{ request()->routeIs('outward.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link outward-toggle {{ request()->routeIs('outward.*') ? 'active' : '' }}">
                        <i
                            class="nav-icon bi-truck {{ request()->routeIs('outward.*') ? 'text-primary' : 'text-muted' }}"></i>
                        <p>
                            Outward Module
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (Auth::user()->hasPermission('View Outward all') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('outward.outward_view_All') }}"
                                    class="nav-link {{ request()->routeIs('outward.outward_view_All') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('outward.outward_view_All') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Type 1</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav nav-treeview">

                        @if (Auth::user()->hasPermission('view all outward type 2') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('outward.all') }}"
                                    class="nav-link {{ request()->routeIs('outward.all') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('outward.all') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Type 2</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    @if (Auth::user()->hasPermission('view all inward') || Auth::user()->id == '1')
                            <li class="nav-item">
                    <a href="{{ route('inward.inward_view_All') }}"
                        class="nav-link {{ request()->routeIs('inward.inward_view_All') ? 'active' : '' }}">
                        <i
                            class="nav-icon bi bi-box-arrow-in-down {{ request()->routeIs('inward.inward_view_All') ? 'text-primary' : 'text-muted' }}"></i>
                        <p>Inward Module</p>
                    </a>
                      @endif
                </li>
                <li class="nav-item report-menu {{ request()->routeIs('report.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link report-toggle {{ request()->routeIs('report.*') ? 'active' : '' }}">
                        <i
                            class="nav-icon bi bi-file-earmark-bar-graph {{ request()->routeIs('report.*') ? 'text-primary' : 'text-muted' }}"></i>
                        <p>
                            Reports
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (Auth::user()->hasPermission('incentive report') || Auth::user()->id == '1')
                            <li class="nav-item">
                                <a href="{{ route('report.report_intencive') }}"
                                    class="nav-link {{ request()->routeIs('report.report_intencive') ? 'active' : '' }}">
                                    <i
                                        class="nav-icon bi bi-circle {{ request()->routeIs('report.report_intencive') ? 'text-primary' : 'text-muted' }}"></i>
                                    <p>Intencive</p>
                                </a>
                            </li>
                        @endif
                    </ul>

                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- JavaScript for toggling dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLinks = document.querySelectorAll('.masterfiles-toggle');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = link.parentElement;
                parentLi.classList.toggle('menu-open');
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLinks = document.querySelectorAll('.permissions-toggle');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = link.parentElement;
                parentLi.classList.toggle('menu-open');
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLinks = document.querySelectorAll('.outward-toggle');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = link.parentElement;
                parentLi.classList.toggle('menu-open');
            });
        });
    });
     document.addEventListener('DOMContentLoaded', function() {
        const toggleLinks = document.querySelectorAll('.report-toggle');

        toggleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parentLi = link.parentElement;
                parentLi.classList.toggle('menu-open');
            });
        });
    });
</script>
