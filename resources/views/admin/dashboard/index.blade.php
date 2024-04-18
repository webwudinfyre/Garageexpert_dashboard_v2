@extends('admin.layouts.master')
<style type="text/css">
    #image-preview {
        width: 400px;
        height: 400px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
    }

    #image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }

    #image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        background-color: #bdc3c7;
        width: 200px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        text-transform: uppercase;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
    }
        #calendar {
        width: 100%;
        height: 100vh; /* Adjust the height as needed */
    }
</style>


@section('contents')
    <div class="pagetitle">
        <h1>Admin Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">


            @include('components.task_status_admin')

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">


                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Calender <span></span></h5>

                                <div id="calendar"></div>
                                <!-- Line Chart -->
                                {{-- <div id="reportsChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                            </script> --}}
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    {{-- <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div> --}}

                                    <div class="card-body">
                                        <h5 class="card-title">Product Review <span>| Latest</span></h5>
                                        {{-- @php
                                    printf($customer_reviews);
                                    @endphp --}}

                                        <div class="activity">



                                            @foreach ($customer_reviews as $review1)
                                                <div class="activity-item d-flex">
                                                    <div class="activite-label"> {{ $review1->updated_at->format('H:i:s') }}
                                                    </div>
                                                    <i
                                                        class="bi bi-circle-fill activity-badge {{ $review1->color_class }} align-self-start"></i>
                                                    <div class="activity-content">
                                                        @for ($i = 1; $i <= $review1->Product_reviews_star; $i++)
                                                            {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating"
                                                    value="5" /> --}}
                                                            <label class="star-rating-complete" title="text"><i
                                                                    class="bi bi-star-fill"></i> </label>
                                                        @endfor
                                                        <br>{!! $review1->Type_service->service_name !!}
                                                        <br>{!! $review1->product_task_rew->product_add->client_pdt->office !!}
                                                        {{-- <br>{{ $review1->Product_reviews }} --}}


                                                        {{-- {!! $review->Product_reviews_star !!} --}}

                                                    </div>
                                                </div><!-- End activity item-->
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    {{-- <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div> --}}

                                    <div class="card-body">
                                        <h5 class="card-title">Technician Review <span> | Latest</span></h5>


                                        <div class="activity">



                                            @foreach ($customer_reviews as $review)
                                                <div class="activity-item d-flex">
                                                    <div class="activite-label"> {{ $review->updated_at->format('H:i:s') }}
                                                    </div>
                                                    <i
                                                        class="bi bi-circle-fill activity-badge {{ $review->color_class }} align-self-start"></i>
                                                    <div class="activity-content">
                                                        @for ($i = 1; $i <= $review->tech_reviews_star; $i++)
                                                            {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating"
                                                    value="5" /> --}}
                                                            <label class="star-rating-complete" title="text"><i
                                                                    class="bi bi-star-fill"></i> </label>
                                                        @endfor
                                                        <br>{!! $review->tech_user_rew->name !!}
                                                        <br>{{ $review->tech_reviews }}


                                                        {{-- {!! $review->Product_reviews_star !!} --}}

                                                    </div>
                                                </div><!-- End activity item-->
                                            @endforeach


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- End Recent Sales -->


                </div>
            </div><!-- End Left side columns -->


            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    {{-- <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div> --}}


                    <div class="card-body">
                        <h5 class="card-title">Recent Task <span> | Latest</span></h5>

                        <div class="activity">


                            @foreach ($task as $task_view)
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> {{ $task_view->updated_at->format('Y-m-d') }}

                                        <br>{{ $task_view->updated_at->format('H:i:s') }}
                                    </div>
                                    <i
                                        class="bi bi-circle-fill activity-badge {{ $task_view->color_class }} align-self-start"></i>
                                    <div class="activity-content">
                                        {{ $task_view->product_add->product_code }}
                                        <br>{!! $task_view->Type_service->service_name !!}
                                        <br>{!! $task_view->task->task_name !!}
                                        <br>{!! $task_view->product_add->client_pdt->office !!}
                                        <br>{!! $task_view->product_add->client_pdt->location !!}


                                    </div>
                                </div><!-- End activity item-->
                            @endforeach


                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                {{-- <div class="card">
                {{-- <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div> --}}

                {{-- <div class="card-body ">
                    <h5 class="card-title">Budget Report <span>| This Month</span></h5>



                </div>
            </div><!-- End Budget Report --> --}}




            </div><!-- End Right side columns -->

        </div>

    </section>

    <section class="view" id="view">
        <div class="modal fade" id="view_equip_1" tabindex="-1" aria-labelledby="view_equip_1" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Task details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('admin.equipment.update') }}" class="row g-3" method="POST">
                    @csrf

                    <input type="text" class="form-control" id="recipient_name" name="id" hidden>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingitem_id" placeholder="Item ID" name="item_id" required autocomplete="item_id" autofocus value="{{ old('item_id') }}" disabled>
                            <label for="floatingitem_id">Item ID</label>
                            @error('item_id')
                            <div class="alert-color" role="alert">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingBrand" placeholder="Brand Name" name="Brand" required autocomplete="Brand" autofocus value="{{ old('Brand') }}">
                            <label for="floatingBrand">Brand Name</label>
                            @error('Brand')
                            <div class="alert-color" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            {{-- <input type="text" class="form-control" id="floatingItem_name"
                                    placeholder="Item Name" name="Item_name" required autocomplete="Item_name" autofocus
                                    value="{{ old('Item_name') }}">
                            <label for="floatingItem_name">Item Name</label> --}}
                        {{-- <textarea class="form-control" name="Item_name" placeholder="Address"
                                    id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Equipment Name</label>
                                @error('Item_name')
                                <div class="alert-color" role="alert">
                                    {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-floating">

                        <input type="text" class="form-control" id="floatingModel" placeholder="Model" name="Model" required autocomplete="Model" autofocus value="{{ old('Model') }}">
                        <label for="floatingModel">Model</label>
                        @error('Brand')
                        <div class="alert-color" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>






                <div class="text-center">

                    <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                </div>
                </form> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        {{-- <script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script> --}}

        {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script> --}}
        <script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script>
        {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events',
                eventColor: function(event) {
                    if (event.extendedProps.status === 'completed') {
                        return 'green';
                    } else if (event.extendedProps.status === 'new') {
                        return 'blue';
                    } else {
                        return 'red';
                    }
                }
            });

            calendar.render();
        });
</script> --}}
        {{-- <script>
    $(document).ready(function() {
            // Initialize the calendar
            $('#calendar').fullCalendar({
                // Calendar options
                // ...

                // Event to trigger when date is clicked

                viewRender: function(view, element) {
                // Get the currently displayed date range
                var start = view.intervalStart.format('YYYY-MM-DD');
                var end = view.intervalEnd.format('YYYY-MM-DD');

                // Fetch tasks and events for the displayed date range
                fetchTasksAndEvents(start, end);
            }
            });

            // Function to fetch tasks and events for a given date
            function fetchTasksAndEvents(date) {
                $.ajax({
                    url: '/tasks',
                    type: 'GET',
                    data: { date: date },
                    success: function(tasks) {

                        // Process tasks and mark dates on the calendar
                        tasks.forEach(function(task) {
                            $('#calendar').fullCalendar('renderEvent', {
                                title: task.title,
                                start: task.date,
                                // Add more properties as needed
                            }, true);
                        });
                    }
                });

            }
        });
</script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: '/tasks',


                    dateClick: function(info) {
                        // Example: Fetch additional details using AJAX
                        $.ajax({
                            url: '/get_event_details', // Your backend endpoint
                            method: 'get',
                            data: {
                                date: info.dateStr // Send the clicked date to the server
                            },
                            success: function(response) {
                                console.log(response);
                                var modalBodyContent =
                                    '<table class="table table-responsive"><thead><tr><th>Product Code</th><th>Serial Number</th><th>Description</th><th>Status</th></tr></thead><tbody>';
                                response.forEach(function(item) {
                                    modalBodyContent += '<tr><td>' + item.product_add
                                        .product_code + '</td><td>' + item.product_add
                                        .serial_number + '</td><td><ul><li>' +
                                        'Brand :' + item.product_add.equip_pdt.Brand +
                                        '</li><li>' + 'Model :' + item.product_add
                                        .equip_pdt.Model + '</li><li>' + 'name :' + item
                                        .product_add.equip_pdt.Item_name +
                                        '</li></ul></td><td>' + item.task.task_name +
                                        '</td></tr>';

                                });
                                $('#view_equip_1 .modal-body').html(modalBodyContent);
                                $('#view_equip_1').modal('show');
                            },
                            error: function(error) {
                                console.error('Error fetching event details:', error);
                            }
                        });
                    }

                    // dateClick: function(info) {
                    //     // Example: Show a modal with the clicked date

                    //     $('#view_equip_1').modal('show');



                    // }

                });

                calendar.render();
            });
        </script>
    @endpush

    {{--
<div id="image-preview">
    <label for="image-upload" id="image-label">Choose File</label>
    <input type="file" name="image" id="image-upload" />
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="{{asset('admin/assets/js/upload-preview/assets/js/uploadPreview.min.js')}}"></script>
<script src="{{asset('admin/assets/js/up-pr/features-post-create.js')}}"></script> --}}

    <!-- Your script using jQuery -->
@endsection
