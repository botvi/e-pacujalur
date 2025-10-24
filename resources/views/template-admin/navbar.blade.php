<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ asset('admin') }}/dashboard/index.html" class="b-brand text-primary">
                <img src="{{ asset('env') }}/logo_text.png" alt="Logo" style="height: 40px;">
            </a>
        </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-superadmin" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <i class="ti ti-dashboard"></i>
                        <label>Data e-Pacu</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('managejalur.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-geometry"></i></span>
                            <span class="pc-mtext">Manage Jalur</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('managegelanggang.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-building"></i></span>
                            <span class="pc-mtext">Manage Gelanggang</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manageevent.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-star"></i></span>
                            <span class="pc-mtext">Manage Event</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('managejuarapacujalur.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-trophy"></i></span>
                            <span class="pc-mtext">Manage Juara Pacu Jalur</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manageundianpacu.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                            <span class="pc-mtext">Manage Undian Pacu</span>
                        </a>
                    </li>
                </ul>
            </div>
    </div>
</nav>
