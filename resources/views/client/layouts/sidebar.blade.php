    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="/client/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Client Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Office List</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>

            </li> --}}

            <li class="nav-item {{ Request::is('client/office/*') ? 'active' : '' }}">
                <a class="nav-link collapsed"
                    href="{{ route('client.client.office_list', ['id' => encrypt(Auth::user()->id)]) }}">
                    <i class="bi bi-person"></i>
                    <span>Office List</span>
                </a>
            </li>


            {{-- <!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Register Complaint</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>

            </li><!-- End Forms Nav -->

            <li class="nav-item {{ Request::is('admin/reports/*') ? 'active' : '' }}">
                <a class="nav-link collapsed" data-bs-target="#Reports" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Review</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ Request::is('admin/reports/clientreport') ? 'active' : '' }}"
                            href="{{ route('admin.reports.clientreport') }}">
                            <i class="bi bi-circle"></i><span>Product Review</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('admin/reports/techreport') ? 'active' : '' }}"
                            href="{{ route('admin.reports.techreport') }}">
                            <i class="bi bi-circle"></i><span>Technician Review</span>
                        </a>
                    </li>

                    <li>
                        <a class="{{ Request::is('admin/report/customer_review') ? 'active' : '' }}"
                            href="{{ route('admin.reports.customer_review') }}">
                            <i class="bi bi-circle"></i><span>Customer Review</span>
                        </a>
                    </li>

                </ul>
            </li> --}}


            <li class="nav-item {{ Request::is('client/client/Review/*') ? 'active' : '' }}">
                <a class="nav-link collapsed"
                    href="{{ route('client.client.client_review', ['id' => Auth::user()->id]) }}">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Review</span>
                </a>
            </li>


            <li class="nav-heading">Pages</li>

            {{--  --}}
            <li class="nav-item">
                <a class="nav-link collapsed"
                    href="{{ route('client.registration.clientdprofilemain', ['id' => encrypt(Auth::user()->id)]) }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            {{-- <li class="nav-item">
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
            </li><!-- End Blank Page Nav --> --}}

        </ul>

    </aside><!-- End Sidebar-->
