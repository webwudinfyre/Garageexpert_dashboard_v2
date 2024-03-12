    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('tech/dashboard') ? 'active' : '' }}" href="/tech/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Tech Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item {{ Request::is('tech/joballocation/*') ? 'active' : '' }}">
                <a class="nav-link collapsed" data-bs-target="#Job_Allocation" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Job Allocation</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="Job_Allocation" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a class="{{ Request::is('tech/joballocation/job_list') ? 'active' : '' }}"
                            href="{{ route('tech.joballocation.job_list') }}">
                            <i class="bi bi-circle"></i><span>Job List</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('tech/joballocation/myjob_list') ? 'active' : '' }}"
                            href="{{ route('tech.joballocation.myjob_list') }}">
                            <i class="bi bi-circle"></i><span>My Job List</span>
                        </a>
                    </li>
                    <!-- Add more list items for other job allocation pages -->
                </ul>
            </li>
    <!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>

            </li><!-- End Forms Nav -->


            <li class="nav-heading">Pages</li>
            {{--  --}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('tech.registration.techprofilemain', ['id' => encrypt(Auth::user()->id)]) }}">
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
