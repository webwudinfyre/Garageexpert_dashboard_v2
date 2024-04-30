<style>

</style>
@if (auth()->check() && auth()->user()->notifications->count() > 0)



    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary_expert badge-number">{{ auth()->user()->unreadNotifications->count() }}</span>
    </a><!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            You have {{ auth()->user()->unreadNotifications->count() }} new notifications
            <a href="{{ route('admin.joballocation.job_list') }}"><span
                    class="badge rounded-pill bg-primary_expert p-2 ms-2">View all</span></a>
        </li>

        @foreach (auth()->user()->notifications as $key => $notification)

            @if ($key <= 5)

                @if (empty($notification->read_at))
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div class="d-flex" >
                            <div class="row">
                                <h4>{{ $notification->prdt_task->product_add_not->product_code }}</h4>
                                <p>{{ json_decode($notification->data)->message ?? 'New Notification' }}</p>

                            </div>

                            <a  href="{{ route('client.joballocation.mark_as_read', ['id' => encrypt($notification->id)]) }}" ><span class="mark_as_read"> <i class="bi bi-envelope-paper"></i></span></a>
                        </div>


                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                @endif

            @endif


        @endforeach

        <li class="dropdown-footer">
            <a href="{{ route('client.joballocation.mark_as_read_all', ['id' => encrypt(Auth::user()->id)]) }}">Mark all Read</a>
        </li>

    </ul><!-- End Notification Dropdown Items -->

@else
<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <span class="badge bg-primary_expert badge-number">{{ auth()->user()->unreadNotifications->count() }}</span>
</a><!-- End Notification Icon -->

@endif
