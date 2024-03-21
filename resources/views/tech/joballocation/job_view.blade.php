@extends('tech.layouts.master')

@section('contents')
    <style>
        .bluck_add {

            padding: 20px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .under_line {}

        #job_deatail_v2 .under_line {}

        .custom-border {
            border-bottom: 1px solid;
            border-image: linear-gradient(to right, #d1d1d1 98%, white 98%);
            border-image-slice: 1;
            margin-bottom: 5px;
        }
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Job Details</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('tech.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Job Details</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-4 d-flex justify-content-end">
                    <div id="view_job_l" class="action_icon ">
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" href="">
                            <button type="button" class="btn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </a>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download"
                            href="{{ route('tech.joballocation.job_pdf_dowmload', ['id' => encrypt($data->product_id)]) }}">
                            <button type="button" class="btn">
                                <i class="bi bi-download"></i></i>
                            </button>
                        </a>
                        @if ($prdt_task_2->task_id !== 3)
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Start Work"
                                href="{{ route('tech.joballocation.jobinstall', ['id' => encrypt($pdut_id)]) }}">
                                <button type="button" class="btn">


                                    <i class="bi bi-lightning"></i>
                                </button>
                            </a>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign to Job">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assign_to"
                                    data-bs-whatever={{ $pdut_id }}>
                                    <i class="bi bi-person-fill-up"></i>
                                </button>
                            </a>
                        @endif

                        @if ($admin_id !== Auth::user()->id)
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add My Job">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#taken_by"
                                    data-bs-whatever={{ $pdut_id }}>
                                    <i class="bi bi-person-fill-add"></i>
                                </button>
                            </a>
                        @endif





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
                                    <h5 class="card-title">Job Information</h5>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <div id="job_deatail_v1" class="bluck_add mb-4">
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
                                                        <p class="text-muted job_detatil_v3">{{ $data->client_pdt->office }}
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
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $data->client_pdt->location }}</p>
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
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $data->client_pdt->users->email }}</p>
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
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $data->client_pdt->phonenumber }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>

                            </div>

                            <div class="col-12">

                                <div id="job_deatail_v2" class="bluck_add mb-4">
                                    <div class="head-profie">
                                        <h5 class="card-title">Product Details</h5>

                                    </div>
                                    <div class="row gy-3">

                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Code</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">{{ $data->product_code }}</p>
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
                                                        <p class="text-muted job_detatil_v3">{{ $data->equip_pdt->Brand }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">
                                                <div class="row ">

                                                    <div class="col-6 ">
                                                        <p class="mb-0">Model</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">{{ $data->equip_pdt->Model }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">

                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Name </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $data->equip_pdt->Item_name }}</p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">

                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Warranty </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $data->warranty->warranty_type === '1' ? 'Yes' : 'No' }}</p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        @if ($data->warranty->warranty_type === '1')
                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty Current Status</p>
                                                        </div>
                                                        <div class="col-6">
                                                            @php
                                                                $endDate = \Carbon\Carbon::parse(
                                                                    $data->warranty->end_date,
                                                                );
                                                                $currentDate = \Carbon\Carbon::now();
                                                                $isWarrantyValid = $endDate->gte($currentDate);
                                                            @endphp

                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $isWarrantyValid ? 'Yes' : 'No' }}</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty Start Date</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $data->warranty->Start_date }}</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty End Date</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $data->warranty->end_date }}</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif



                                    </div>


                                </div>

                            </div>




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
                                    <h5 class="card-title">Task History </h5>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 ps-4 pe-4">


                                <div class="row gy-3">


                                    @php
                                        use Carbon\Carbon;

                                        // Flatten the array and sort it by 'date_time'
                                        $sortedArray = collect($taskHistoryArray)
                                            ->flatten(1)
                                            ->sortBy(function ($item) {
                                                return Carbon::parse($item['date']);
                                            });
                                    @endphp
                                    @foreach ($sortedArray as $data)
                                        <div class="bluck_add mb-4">
                                            <div class="head-profie">
                                                <h5 class="card-title">
                                                    {{ ucfirst(str_replace('_', ' ', $data['name'])) }}</h5>

                                            </div>



                                            <div class="row gy-3">
                                                <div class="col-md-6 custom-border">
                                                    <div class="under_line ">

                                                        <div class="row ">
                                                            <div class="col-6 ">
                                                                <p class="mb-0">Services</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="text-muted job_detatil_v3">
                                                                    {{ $data['Services'] }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                @if ($data['assign'] === $data['user_id'])
                                                    <div class="col-md-6 custom-border">
                                                        <div class="under_line ">

                                                            <div class="row ">
                                                                <div class="col-6 ">
                                                                    <p class="mb-0">Technician name</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="text-muted job_detatil_v3">
                                                                        {{ $data['user_name'] }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="col-md-6 custom-border">
                                                        <div class="under_line ">

                                                            <div class="row ">
                                                                <div class="col-6 ">
                                                                    <p class="mb-0">Technician name</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="text-muted job_detatil_v3">
                                                                        [{{ $data['user_name'] }}] <span
                                                                            class="assign_to">Assign To </span>
                                                                        [{{ $data['assign_name'] }}]
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                                <div class="col-md-6 custom-border">
                                                    <div class="under_line ">

                                                        <div class="row ">
                                                            <div class="col-6 ">
                                                                <p class="mb-0">Date Of Schedule</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="text-muted job_detatil_v3">
                                                                    {{ $data['Date_Of_Schedule'] }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 custom-border">
                                                    <div class="under_line ">

                                                        <div class="row ">
                                                            <div class="col-6 ">
                                                                <p class="mb-0">Date Of Action</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="text-muted job_detatil_v3">
                                                                    {{ $data['date'] }} {{ $data['time'] }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 custom-border">
                                                    <div class="under_line ">

                                                        <div class="row ">
                                                            <div class="col-6 ">
                                                                <p class="mb-0">Remarks</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="text-muted job_detatil_v3">
                                                                    {{ $data['Remarks'] }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                @if ($data['name'] === 'install')
                                                    <div class="col-md-6 custom-border">
                                                        <div class="under_line ">

                                                            <div class="row ">
                                                                <div class="col-6 ">
                                                                    <p class="mb-0">Signature person</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="text-muted job_detatil_v3">
                                                                        {{ $data['sign_name'] }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 custom-border">
                                                        <div class="under_line ">

                                                            <div class="row ">
                                                                <div class="col-6 ">
                                                                    <p class="mb-0">postion</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="text-muted job_detatil_v3">
                                                                        {{ $data['sign_postion'] }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 custom-border">
                                                        <div class="under_line ">

                                                            <div class="row ">
                                                                <div class="col-6 ">
                                                                    <p class="mb-0">signature</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="text-muted job_detatil_v3">
                                                                        <img src="{{ $data['sign_signature_data'] }}"
                                                                            width="150px" height="40px" />
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- @foreach ($sortedArray as $data)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3>{{ ucfirst(str_replace('_', ' ', $data['name'])) }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Key</th>
                                                                    <th>Value</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data as $key => $value)
                                                                    @if ($key !== 'name' && $key !== 'date_time') <!-- Exclude 'name' and 'date_time' keys -->
                                                                        <tr>
                                                                            <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                                                            <td>{{ $value }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach --}}


                                    {{-- <div class="table-responsive">
                                            <table id="admin_table" class="table datatable table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>sl.no</th>
                                                        <th>Services</th>
                                                        <th>Date Of Schedule</th>
                                                        <th>Technician Name</th>
                                                        <th>Date Reached</th>
                                                        <th>Reamarks</th>
                                                        <th>Task status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($taskHistoryArray as $key => $taskHistoryArray)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $key }}</td>
                                                            @foreach ($taskHistoryArray as $taskHistoryArray_v1)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div> --}}


                                </div>




                            </div>
                        </div>

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
                                                        <p class="mb-0">Office Name</p>
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
                                                        <p class="mb-0">Location Name</p>
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
@endsection
