@extends('tech.layouts.master')

@section('contents')
<div class="pagetitle">
    <h1>Tech Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
<div class="col-12">
    <x-example-component adminId='{{ Auth::user()->id }}' admin="tech" />
</div>
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Sales Card -->


              <!-- Reports -->
              <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Calender <span></span></h5>

                        <div id="calendar"></div>

                        <div class="icon_cal mb-1">
                            <i class="bi bi-circle-fill activity-badge orange align-self-start"> New Task </i>
                            <i class="bi bi-circle-fill activity-badge text-primary align-self-start"> Pending </i>
                            <i class="bi bi-circle-fill activity-badge text-success align-self-start"> Completed </i>
                            <i class="bi bi-circle-fill activity-badge text-danger align-self-start"> Quotation </i>
                        </div>




                    </div>

                </div>
            </div><!-- End Reports -->


            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

            <!-- Recent Activity -->
            <div class="card">


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

<script src="https://unpkg.com/fullcalendar@5.10.1/main.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/tasks_1',


            dateClick: function(info) {
                // Example: Fetch additional details using AJAX
                $.ajax({
                    url: '/get_event_details_1', // Your backend endpoint
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

@endsection

