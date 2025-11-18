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
                        <li class="nav-item">
                            <a href="{{ route('permissions.view') }}"
                                class="nav-link {{ request()->routeIs('permissions.view') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('permissions.view') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Permission</p>
                            </a>
                        </li>
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
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.userlevel') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.userlevel') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.userlevel') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>User Levels</p>
                            </a>
                        </li>

                        <!-- Users -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.users') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.users') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.users') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <!-- Centers -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.centers') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.centers') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.centers') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Centers</p>
                            </a>
                        </li>

                        <!-- Vehicles -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.vehicles') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.vehicles') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.vehicles') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Vehicles</p>
                            </a>
                        </li>

                        <!-- Drivers -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.drivers') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.drivers') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.drivers') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Drivers</p>
                            </a>
                        </li>

                        <!-- Helpers -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.helpers') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.helpers') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.helpers') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Helpers</p>
                            </a>
                        </li>

                        <!-- Security -->
                        <li class="nav-item">
                            <a href="{{ route('Masterfile.securities') }}"
                                class="nav-link {{ request()->routeIs('Masterfile.securities') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->routeIs('Masterfile.securities') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Security</p>
                            </a>
                        </li>

                        <!-- Incentive -->
                        <li class="nav-item">
                            <a href="./widgets/cards.html"
                                class="nav-link {{ request()->is('widgets/cards.html') ? 'active' : '' }}">
                                <i
                                    class="nav-icon bi bi-circle {{ request()->is('widgets/cards.html') ? 'text-primary' : 'text-muted' }}"></i>
                                <p>Incentive</p>
                            </a>
                        </li>

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
</script>
