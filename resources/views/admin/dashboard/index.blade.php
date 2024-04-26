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
        height: 100vh;
        /* Adjust the height as needed */
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

                            <div class="card-body">
                                <h5 class="card-title">Calender <span></span></h5>

                                <div id="calendar"></div>

                                <div class="icon_cal mb-1">
                                    <i class="bi bi-circle-fill activity-badge orange align-self-start"> New Task </i>
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"> Pending </i>
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"> Completed
                                    </i>
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"> Quotation </i>
                                </div>




                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">



                        <div class="card">

                            <div class="filter">

                                <a class="icon" href="{{ route('admin.admin.tracking_details') }}">View More</a>

                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Tracking <span>/Latest</span></h5>

                                <div id="timeline-container" class="timeline-container">
                                    <div id="timeline" class="timeline">
                                        <div class="row">
                                            @foreach ($taskHistoryArray as $taskId => $taskHistory1)
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <div class="timeline_card_head">
                                                                <h4 class="card-title">Code :
                                                                    {{ $taskHistory1['product_add_code'] }} </h4>

                                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="View"
                                                                    href="{{ route('admin.joballocation.job_list_view', ['id' => encrypt($taskHistory1['product_add'])]) }}">

                                                                    <i class="bi bi-eye"></i>

                                                                </a>
                                                            </div>

                                                            <ul id="timeline-3" class="timeline-3">
                                                                <li>

                                                                    <p>Service: {{ $taskHistory1['service_name'] }}</p>
                                                                    <p>Brand: {{ $taskHistory1['Brand'] }}</p>
                                                                    <p>Model: {{ $taskHistory1['Model'] }}</p>
                                                                    <p>Name: {{ $taskHistory1['Item_naame'] }}</p>
                                                                    <p>Status: {{ $taskHistory1['Status'] }}</p>

                                                                </li>
                                                                @foreach ($taskHistory1 as $key => $value)
                                                                    @if (is_array($value) && $key !== 'product_add' && $key !== 'product_add_code' && $key !== 'service_name')
                                                                        <li>
                                                                            @php
                                                                                $subValueParts = explode(
                                                                                    '_next_',
                                                                                    $value['name'],
                                                                                );
                                                                                $lastPart = end($subValueParts);
                                                                            @endphp
                                                                            <div class="timeline-date">
                                                                                <div class="timeline_head">
                                                                                    {{ ucfirst(str_replace('_', ' ', $lastPart)) }}
                                                                                </div>
                                                                                <div class="timeline_head">
                                                                                    {{ $value['Date_Of_Schedule'] }}</div>
                                                                            </div>


                                                                            <div class="timeline-content">


                                                                                <p>Task Status:
                                                                                    {{ $value['task_name_status'] === 'New Task' ? 'Progress' : $value['task_name_status'] }}
                                                                                </p>

                                                                                <p>Assigned : {{ $value['assign_name'] }}
                                                                                </p>

                                                                                <p>Date Of Schedule:
                                                                                    {{ $value['Date_Of_Schedule'] }}</p>

                                                                                @if (isset($value['quotationValue_value_data']))
                                                                                    <p>Quotation Status:
                                                                                        {{ $value['quotationValue_value_data'] }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- <div class="d-flex">
                                        {!! $client_latest->links() !!}
                                    </div> --}}
                                </div>


                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>


                    </div><!-- End Recent Sales -->


                </div>
            </div><!-- End Left side columns -->


            <!-- Right side columns -->
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <!-- Recent Activity -->
                        <div class="card">



                            <div class="card-body">
                                <h5 class="card-title">Recent Task <span> | Latest</span></h5>

                                <div class="activity">


                                    @foreach ($task2 as $task_view1)
                                        <div class="activity-item d-flex">
                                            <div class="activite-label"> {{ $task_view1->updated_at->format('Y-m-d') }}

                                                <br>{{ $task_view1->updated_at->format('H:i:s') }}
                                            </div>
                                            <i
                                                class="bi bi-circle-fill activity-badge {{ $task_view1->color_class }} align-self-start"></i>
                                            <div class="activity-content">
                                                {{ $task_view1->product_add->product_code }}
                                                <br>{!! $task_view1->Type_service->service_name !!}
                                                <br>{!! $task_view1->task->task_name !!}
                                                <br>{!! $task_view1->product_add->client_pdt->office !!}
                                                <br>{!! $task_view1->product_add->client_pdt->location !!}


                                            </div>
                                        </div><!-- End activity item-->
                                    @endforeach


                                </div>

                            </div>



                        </div><!-- End Recent Activity -->

                    </div>
                    <div class="col-lg-12">
                        <div class="card" style="height: 475px; overflow-y: auto; scrollbar-width: 1px;">


                            <div class="card-body">
                                <h5 class="card-title">Product Review <span>| Latest</span></h5>


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

                    <div class="col-12">
                        <div class="card" style="
        height: 475px;
        overflow-y: auto;">



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





            </div>

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

                    </div>

                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script>

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
