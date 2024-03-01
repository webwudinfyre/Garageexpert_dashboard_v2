<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard.index') }}">
                <i class="bi bi-grid"></i>
                <span>Admin Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item {{ Request::is('admin/registration/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" data-bs-target="#registration" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Registration</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="registration" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>

                    <a class="{{ Request::is('admin/registration/admin') ? 'active' : '' }}"
                        href="{{ route('admin.registration.admindetails') }}">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/registration/client') ? 'active' : '' }}"
                        href="{{ route('admin.registration.clientdetails') }}">
                        <i class="bi bi-circle"></i><span>Client</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::is('admin/registration/tech') ? 'active' : '' }}"
                        href="{{ route('admin.registration.techdetails') }}">
                        <i class="bi bi-circle"></i><span>Technicians</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-item {{ Request::is('admin/equipments/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" data-bs-target="#Equipments" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Equipments</span>
                <i class="bi bi-chevron-down ms-auto"></i>

            </a>
            <ul id="Equipments" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>

                    <a class="{{ Request::is('admin/equipments/view') ? 'active' : '' }}"
                        href="{{ route('admin.equipments.view') }}">
                        <i class="bi bi-circle"></i><span>Equipments List</span>
                    </a>
                </li>


            </ul>

        </li><!-- End Tables Nav -->


        <!-- Job Allocation Nav -->
        <li class="nav-item {{ Request::is('admin/joballocation/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" data-bs-target="#Job_Allocation" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Job Allocation</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Job_Allocation" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Request::is('admin/joballocation/view') ? 'active' : '' }}"
                        href="{{ route('admin.joballocation.view') }}">
                        <i class="bi bi-circle"></i><span>Add Job Allocation</span>
                    </a>
                </li>
                <!-- Add more list items for other job allocation pages -->
            </ul>
        </li>



        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Job Allocation</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

        </li><!-- End Forms Nav --> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

        </li><!-- End Charts Nav -->

        <li class="nav-heading">Pages</li>

        {{--  --}}
        <li class="nav-item">
            <a class="nav-link collapsed"
                href="{{ route('admin.registration.admindprofilemain', ['id' => encrypt(Auth::user()->id)]) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->


