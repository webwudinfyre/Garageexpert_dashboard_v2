@extends('tech.layouts.master')

@section('contents')
    <style>
        .start_date {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bluck_add {}
    </style>
    <style>
        #assign_to select.form-select option.slected {
            background-color: #ff0000;
            /* Change this to your desired color */
            color: #ffffff;
            /* Change this to your desired text color */
        }

        #assign_to .ui-widget.ui-widget-content {
            border: 1px solid #c5c5c5;
            border-radius: 5px;
            padding: 5px !important;
        }

        #assign_to ul#ui-id-2 {
            position: relative;
            width: 300px;
            top: -275.531px;
            left: 40px;
        }
    </style>

    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12  align-items-center ">
                    <h1>Job List</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('tech.dashboard.index') }}">Home</a></li>

                            @if (!empty($search_page))
                                <li class="breadcrumb-item active"><a href="{{ route('tech.joballocation.job_list') }}">Job
                                        List</a></li>
                                <li class="breadcrumb-item active">Job Serach Result</li>
                            @else
                                <li class="breadcrumb-item active">Job List</li>
                            @endif
                        </ol>
                    </nav>
                </div>

            </div>

        </div>
    </section>



    {{-- <x-tech-task-main  /> --}}

    {{-- @include('components.task_status_admin') --}}
    {{-- $notifications = auth()->user()->notifications; --}}
    <section class="section pt-3" id="section_Search">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body ">
                        <div class="row gy-3 mt-3">

                            <form action="{{ route('tech.joballocation.search') }}" class="row g-3" method="GET">

                                <div class="col-xxl-3 col-md-6 ">
                                    <div class="row">
                                        <div class="start_date">
                                            <div class="col-sm-4 mt-2">
                                                <label for="inputDate" class="form-label">Start Date :</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="Start_date"
                                                    autocomplete="Start_date"
                                                    value="{{ !empty($search_page) ? $search_page['start_date'] : '' }}">
                                            </div>

                                        </div>
                                        @error('Start_date')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div class="row">
                                        <div class="start_date">
                                            <div class="col-sm-4  mt-2">
                                                <label for="inputDate" class="form-label">End Date :</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="End_date"
                                                    autocomplete="End_date"
                                                    value="{{ !empty($search_page) ? $search_page['end_date'] : '' }}">
                                            </div>

                                        </div>
                                        @error('End_date')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6 text-center">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <select class="form-select" aria-label="Default select example"
                                                name="Task_value">
                                                <option value="" selected>Please Choose Task</option>

                                                @foreach ($task as $item)
                                                    <option value="{{ $item->id }} "
                                                        {{ !empty($search_page) && $search_page['Task_value'] == $item->id ? 'selected' : '' }}>
                                                        <span class="service_option_size">
                                                            {{ $item->task_name }} </span>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xxl-3 col-md-6 text-center ">
                                    <div class="search">
                                        <div class="form-floating mb-3 ">
                                            <button type="submit" class="btn bg-primary_expert"
                                                style="height: 100%; width:50%">search</button>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section pt-3" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Job List</h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @foreach ($prdt_task as $productId => $groupedItems)
                            <div class="bluck_add mb-5 mt-2">
                                <h6 class="task_name mb-2 mt-2">Task : {{ $productId }}</h6>
                                <!-- Table with stripped rows -->
                                <div class="table-responsive">
                                    <table id="admin_table" class="table datatable table-striped">
                                        <thead>
                                            <tr>
                                                <th>sl.no</th>
                                                <th> Product Code</th>
                                                <th>Company Name</th>
                                                <th>Loaction</th>
                                                <th>Service</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($groupedItems as $prdt_task)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $prdt_task->product_add->product_code }}</td>
                                                    <td>{{ $prdt_task->product_add->client_pdt->office }}</td>
                                                    <td>{{ $prdt_task->product_add->client_pdt->location }}</td>
                                                    <td>{{ $prdt_task->type_service->service_name }}</td>
                                                    <td>
                                                        <div class="action_icon ">
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="View"
                                                                href="{{ route('tech.joballocation.job_list_view', ['id' => encrypt($prdt_task->product_id)]) }}">

                                                                <button type="button" class="btn">
                                                                    <i class="bi bi-eye"></i>
                                                                </button>
                                                            </a>

                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Start Work"
                                                                href="{{ route('tech.joballocation.jobinstall', ['id' => encrypt($prdt_task->id)]) }}">
                                                                <button type="button" class="btn">


                                                                    <i class="bi bi-lightning"></i>
                                                                </button>
                                                            </a>
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Add My Job">
                                                                <button type="button" class="btn"
                                                                    data-bs-toggle="modal" data-bs-target="#taken_by"
                                                                    data-bs-whatever={{ $prdt_task->id }}>
                                                                    <i class="bi bi-person-fill-add"></i>
                                                                </button>
                                                            </a>

                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-title="Assign to Job">
                                                                <button type="button" class="btn"
                                                                    data-bs-toggle="modal" data-bs-target="#assign_to"
                                                                    data-bs-whatever={{ $prdt_task->id }}>
                                                                    <i class="bi bi-person-fill-up"></i>
                                                                </button>
                                                            </a>


                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="modal fade" id="taken_by" tabindex="-1" aria-labelledby="taken_byLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add My Job </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">

                                <div id="job_deatail_v1" class="">
                                    <div class="head-profie">
                                        <h5 class="card-title">Client Details</h5>

                                    </div>
                                    <div class="row gy-3 gx-1">

                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Company Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Office_Name'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Location Details</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Location_Name'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Email'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Phone Number</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Phone_Number'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>
                            <div class="col-12">

                                <div id="job_deatail_v1" class="">
                                    <div class="head-profie">
                                        <h5 class="card-title">Product Details</h5>

                                    </div>
                                    <div class="row gy-3 gx-1">

                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Code</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Product_Code">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Brand Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Brand_Name">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Model</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Model">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Product_Name">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                    <form action="{{ route('tech.joballocation.job_taken') }}" method="GET">
                        <div class="mb-3">

                            <input type="hidden" class="form-control" name="pdt_id_name" id="pdt_id_name">
                        </div>
                        <div class="mb-3">

                            <input type="hidden" class="form-control" id="user_id" name="user_id"
                                value="{{ Auth::user()->id }}">
                        </div>
                        <div class="modal-footer d-flex " style="justify-content: space-around;">
                            <button type="submit" class="btn bg-primary_expert ">Confirm Job</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <section id='assign'>
        <div class="modal fade" id="assign_to" tabindex="-1" aria-labelledby="assign_to" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add My Job </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-5">

                        <div class="row">
                            <div class="col-12">

                                <div id="job_deatail_v1" class="">
                                    <div class="head-profie">
                                        <h5 class="card-title">Client Details</h5>

                                    </div>
                                    <div class="row gy-3 gx-1">

                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Office Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Office_Name_assign'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Location Details</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Location_Name_assign'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Email_assign'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Phone Number</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Phone_Number_assign'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>
                            <div class="col-12">

                                <div id="job_deatail_v1" class="">
                                    <div class="head-profie">
                                        <h5 class="card-title">Product Details</h5>

                                    </div>
                                    <div class="row gy-3 gx-1">

                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Code</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Product_Code_assign">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Brand Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Brand_Name_assign">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Model</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Model_assign">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id="Product_Name_assign">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>
                        </div>
                        <form action="{{ route('tech.joballocation.job_assign') }}" method="GET">
                            <div id="assign_to" class="row">
                                <div class="mb-3">

                                    <input type="hidden" class="form-control" name="pdt_id_name_assign"
                                        id="pdt_id_name_assign">
                                </div>
                                <div class="mb-3">

                                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                                        value="{{ Auth::user()->id }}">
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="Technician_name_assign"
                                            name="Technician_name_assign" required>
                                            <option value="">please choose Technician Name

                                            </option>
                                            @foreach ($tech as $technician)
                                                <option value="{{ $technician->user_id }}">
                                                    {{ $technician->firstname }} {{ $technician->lastname }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <label for="floatingPosition">Technician Name</label>


                                    </div>
                                </div>
                                <div class="col-md-6 "
                                    style="
                                display: flex;
                                align-content: center;
                                justify-content: space-around;
                            ">
                                    <div class="Confirm_assign d-flex "
                                        style="justify-content: space-around; align-items:center">
                                        <button type="submit" class="btn bg-primary_expert ">Confirm To Assign
                                            Job</button>
                                    </div>
                                </div>



                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $("#Technician_name_assign").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/tech/joballocation/Technician_name',
                            data: {
                                term: request.term
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var resp = $.map(data, function(obj) {
                                    return {
                                        id: obj.id,
                                        name: obj.firstname + ' ' + obj.lastname,
                                        user_id: obj.user_id,
                                    };
                                });

                                console.log(resp);

                                if (resp.length === 0) {
                                    resp.push({
                                        label: "No entries found",
                                        value: null // You can set this to an appropriate value
                                    });
                                }

                                response(resp);
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Request Error:", status, error);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        // Update the input boxes with the selected technician's name and ID
                        $(this).val(ui.item.name);
                        $(this).siblings(".user-id").val(ui.item.user_id);
                        return false; // Assuming you want to set this value as well
                        return false; // Prevent the default behavior of setting the value in the input box
                    }
                });
            });
        </script>
    @endpush
@endsection
