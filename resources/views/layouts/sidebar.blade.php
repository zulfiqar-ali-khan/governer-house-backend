<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>
                <li class="menu-title" key="t-user-management">User Management</li>
                @can('user-list')
                <li>
                    <a href="{{ route('users.index') ?? '#' }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-user">User</span>
                    </a>
                </li>
                @endcan
                @can('role-list')
                <li>
                    <a href="{{ route('roles.index') ?? '#' }}" class="waves-effect">
                        <i class="bx bx-lock"></i>
                        <span key="t-role">Role</span>
                    </a>
                </li>
                @endcan

                <li class="menu-title" key="t-general">General</li>
                @can('slider-list')
                <li>
                    <a href="{{ route('sliders.index') }}" class="waves-effect">
                        <i class="bx bx-slider"></i>
                        <span key="t-slider">Slider</span>
                    </a>
                </li>
                @endcan
                @can('global-impact-list')
                <li>
                    <a href="{{ route('global-impacts.index') }}" class="waves-effect">
                        <i class="bx bx-image"></i>
                        <span key="t-our-global-image">Our Global Image</span>
                    </a>
                </li>
                @endcan
                @can('governor-message-list')
                <li>
                    <a href="{{ route('governor-messages.index') }}" class="waves-effect">
                        <i class="bx bx-message-square-dots"></i>
                        <span key="t-governor-message">Governor Message</span>
                    </a>
                </li>
                @endcan
                @can('key-initiative-list')
                <li>
                    <a href="{{ route('key-initiatives.index') }}" class="waves-effect">
                        <i class="bx bx-star"></i>
                        <span key="t-key-initiative">Key Initiative</span>
                    </a>
                </li>
                @endcan
                @can('talk-to-governor-list')
                <li>
                    <a href="{{ route('talk-to-governors.index') }}" class="waves-effect">
                        <i class="bx bx-envelope"></i>
                        <span key="t-message-to-governor">Message to Governor</span>
                    </a>
                </li>
                @endcan
                @can('contact-us-list')
                <li>
                    <a href="{{ route('contact-us.index') }}" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-contact-us-messages">Contact Us Messages</span>
                    </a>
                </li>
                @endcan

                <li class="menu-title" key="t-news-and-event">News and Event</li>
                @can('new-and-event-list')
                <li>
                    <a href="{{ route('new-and-events.index') }}" class="waves-effect">
                        <i class="bx bx-news"></i>
                        <span key="t-news-list">News List</span>
                    </a>
                </li>
                @endcan
                @can('newsletter-list')
                <li>
                    <a href="{{ route('news-letters.index') }}" class="waves-effect">
                        <i class="bx bx-card"></i>
                        <span key="t-newsletter-list">Newsletters</span>
                    </a>
                </li>
                @endcan
                <li class="menu-title" key="t-governors-secretaries">Governors and Secretaries</li>
                @can('secretary-list')
                <li>
                    <a href="{{ route('secretaries.index') }}" class="waves-effect">
                        <i class="bx bx-user-voice"></i>
                        <span key="t-secretaries-list">Secretaries List</span>
                    </a>
                </li>
                @endcan
                @can('governor-list')
                <li>
                    <a href="{{ route('governors.index') }}" class="waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span key="t-governors-list">Governors List</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
