@extends('admin.layouts.master')

@section('contents')
    <style>
        .start_date {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12  align-items-center ">
                    <h1>Job List</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                            @if (!empty($search_page))
                                <li class="breadcrumb-item active"><a href="{{ route('admin.joballocation.job_list') }}">Job
                                        List</a></li>
                                <li class="breadcrumb-item active">Job Serach Result</li>
                            @elseif (!empty($task_id))
                                <li class="breadcrumb-item active"><a href="{{ route('admin.joballocation.job_list') }}">
                                        Job
                                        List</a></li>

                                <li class="breadcrumb-item active">
                                    @foreach ($task as $item_list)
                                        @if ($item_list->id == $task_id)
                                            {{ $item_list->task_name }}
                                        @endif
                                    @endforeach
                                </li>
                            @else
                                <li class="breadcrumb-item active">Job List</li>
                            @endif
                        </ol>
                    </nav>
                </div>

            </div>

        </div>
    </section>


    @include('components.task_status_admin')

    {{-- $notifications = auth()->user()->notifications; --}}
    <section class="section pt-3" id="section_Search">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body ">
                        <div class="row gy-3 mt-3">

                            <form action="{{ route('admin.joballocation.search') }}" class="row g-3" method="GET">

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
                                        <th>Task</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prdt_task as $prdt_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $prdt_task->product_add->product_code }}</td>
                                            <td>{{ $prdt_task->product_add->client_pdt->office }}</td>
                                            <td>{{ $prdt_task->product_add->client_pdt->location }}</td>
                                            <td>{{ $prdt_task->type_service->service_name }}</td>
                                            <td>{{ $prdt_task->task->task_name }}</td>

                                            <td>
                                                <div class="action_icon ">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                        href="{{ route('admin.joballocation.job_list_view', ['id' => encrypt($prdt_task->product_id)]) }}">
                                                        <button type="button" class="btn">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </a>
                                                    @if (!empty($task_id) && $prdt_task->task_id == '3')
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-title="Quotation">

                                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                                data-bs-target="#Quotation_aproval"
                                                                data-bs-whatever={{ $prdt_task->id }}>
                                                                <i class="bi bi-arrow-right"></i>
                                                            </button>
                                                        </a>
                                                    @endif

                                                    @if (!empty($task_id) && $prdt_task->task_id == '6')
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Quotation">

                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#Quotation_aproval_waiting"
                                                            data-bs-whatever={{ $prdt_task->id }}>
                                                            <i class="bi bi-arrow-right"></i>
                                                        </button>
                                                    </a>
                                                @endif

                                                </div>


                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id='assign'>
        <div class="modal fade" id="Quotation_aproval" tabindex="-1" aria-labelledby="Quotation_aproval"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Quotation Aproval</h1>
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
                                                        <p class="mb-0">Company Name</p>
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
                                                        <p class="mb-0">Location Name</p>
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
                        <form action="{{ route('admin.joballocation.Quotation_aproval') }}" method="GET">
                            <div id="assign_to" class="row">
                                <div class="mb-3">

                                    <input type="hidden" class="form-control" name="pdt_id_name_assign"
                                        id="pdt_id_name_assign">
                                </div>

                                <div class="mb-3">

                                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                                        value="{{ Auth::user()->id }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="form-floating">

                                            <input type="text" class="form-control" id="reference_number"
                                                name="reference_number" placeholder="Reference Number" required
                                                autocomplete="reference_number" value="{{ old('reference_number') }}" autofocus>
                                            <label for="name">Reference Number</label>


                                        </div>


                                    </div>
                                    <div class="col-md-6"
                                        style="
                                    display: flex;
                                    align-content: center; justify-content: flex-end;">
                                        <div class="Confirm_assign d-flex "
                                            style="justify-content: space-around; align-items:center">
                                            <button type="submit" class="btn bg-primary_expert ">Confirm To Quotation
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 "
                                    style="
                                display: flex;
                                align-content: center;
                                justify-content: space-around;
                            ">

                                </div> --}}



                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id='assign'>
        <div class="modal fade" id="Quotation_aproval_waiting" tabindex="-1" aria-labelledby="Quotation_aproval"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Quotation Aproval</h1>
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
                                                        <p class="mb-0">Company Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Office_Name_assign_1'>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Location Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3" id='Location_Name_assign_1'>
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
                                                        <p class="text-muted job_detatil_v3" id='Email_assign_1'>
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
                                                        <p class="text-muted job_detatil_v3" id='Phone_Number_assign_1'>
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
                                                        <p class="text-muted job_detatil_v3" id="Product_Code_assign_1">
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
                                                        <p class="text-muted job_detatil_v3" id="Brand_Name_assign_1">
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
                                                        <p class="text-muted job_detatil_v3" id="Model_assign_1">
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
                                                        <p class="text-muted job_detatil_v3" id="Product_Name_assign_1">
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>
                        </div>
                        <form action="{{ route('admin.joballocation.Quotation_aproval_waiting') }}" method="GET">
                            <div id="assign_to" class="row">
                                <div class="mb-3">

                                    <input type="hidden" class="form-control" name="pdt_id_name_assign"
                                        id="pdt_id_name_assign_1">
                                </div>

                                <div class="mb-3">

                                    <input type="hidden" class="form-control" id="user_id_1" name="user_id"
                                        value="{{ Auth::user()->id }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="form-floating">


                                            <input type="date" class="form-control" id="Date_Schedule" name="Date_Schedule"
                                            required placeholder="Date Of Schedule">
                                        <label for="Date_Schedule">Date Of Schedule</label>

                                        </div>


                                    </div>
                                    <div class="col-md-6"
                                    style="display: flex; align-content: center; justify-content: flex-end;">
                                        <div class="Confirm_assign d-flex "
                                            style="justify-content: space-around; align-items:center">
                                            <button type="submit" class="btn bg-primary_expert ">Confirm To Quotation
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12 "
                                    style="
                                display: flex;
                                align-content: center;
                                justify-content: space-around;
                            ">

                                </div> --}}



                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
