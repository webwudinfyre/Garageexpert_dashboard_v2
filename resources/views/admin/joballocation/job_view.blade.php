@extends('admin.layouts.master')

@section('contents')
    <style>
        .bluck_add {

            padding: 20px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .under_line {





            /* Optional: Adjust padding for spacing */
        }

        #job_deatail_v2 .under_line {}

        .custom-border {
            border-bottom: 1px solid;
            border-image: linear-gradient(to right, #d1d1d1 98%, white 98%);
            border-image-slice: 1;
            margin-bottom: 5px;
        }

        /* .custom-border::before {
                                                        content: "";
                                                        position: absolute;
                                                        top: 0;
                                                        left: 0;
                                                        right: 0;
                                                        height: 1px;
                                                        background: linear-gradient(to right, black 90%, white 90%);
                                                    }
                                                 */
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Job Details</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Job Details</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-4 d-flex justify-content-end">
                    <div id="view_job_l" class="action_icon ">

                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download"
                            href="{{ route('admin.joballocation.job_pdf_dowmload', ['id' => encrypt($data->product_id)]) }}"
                            onclick="showModal()">
                            <button type="button" class="btn">


                                <i class="bi bi-download"></i></i>
                            </button>
                        </a>







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
                                                        <p class="mb-0">Company Name</p>
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
                                                        <p class="mb-0">Location Details</p>
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
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Serial number</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3"> @nullOrValue($data->serial_number, 'Serial number')</p>
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
                                        {{-- @if ($data->warranty->warranty_type === '1') --}}
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
                                        {{-- @endif --}}



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
                                @foreach ($taskHistoryArray as $taskId => $taskHistory)
                                    {{-- <h2 class="sub_title"><x-tasknameid :taskId="$taskId" /></h2> --}}

                                    @foreach ($taskHistory as $data)
                                        <div class="row gy-3">
                                            <div class="bluck_add mb-4">
                                                <div class="head-profie">
                                                    @php

                                                        $name = explode('_next_', $data['name']);
                                                        $serviceName = end($name);
                                                    @endphp

                                                    <h5 class="card-title">
                                                        {{ ucfirst(str_replace('_', ' ', $serviceName)) }}</h5>


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
                                                                                class="assign_to">Assign To
                                                                            </span>
                                                                            [{{ $data['assign_name'] }}]
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                    @if (!empty($data['Date_Of_Schedule']))
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
                                                    @endif
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
                                                    @if (!empty($data['Remarks']))
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
                                                    @endif

                                                    @if (!empty($data['quotationValue_value_data']))
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Quotation Status</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            {{ $data['quotationValue_value_data'] }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                    @if (!empty($data['signatures_data']))
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Signature person</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            {{ $data['signatures_data']->name }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Position</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            {{ $data['signatures_data']->postion }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Email</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            {{ $data['signatures_data']->email_id_sign }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Phone</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            {{ $data['signatures_data']->phone_sign }}
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
                                                                            <img src="{{ $data['signatures_data']->signature_data }}"
                                                                                width="150px" height="40px" />
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                    @if (!empty($data['aproval_waiting']))
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Reference Number</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            @nullOrValuenostyle($data['aproval_waiting']->Refrence_number, 'Reference Number')

                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 custom-border">
                                                            <div class="under_line ">

                                                                <div class="row ">
                                                                    <div class="col-6 ">
                                                                        <p class="mb-0">Start Date</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="text-muted job_detatil_v3">
                                                                            @nullOrValuenostyle($data['aproval_waiting']->date_start, 'Start Date')

                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        @if (!empty($data['aproval_waiting']->date_end))
                                                            <div class="col-md-6 custom-border">
                                                                <div class="under_line ">

                                                                    <div class="row ">
                                                                        <div class="col-6 ">
                                                                            <p class="mb-0">End date</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="text-muted job_detatil_v3">
                                                                                @nullOrValuedata($data['aproval_waiting']->date_end, 'End Date')
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6 custom-border">
                                                                <div class="under_line ">

                                                                    <div class="row ">
                                                                        <div class="col-6 ">
                                                                            <p class="mb-0">Toatal Date Approval</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="text-muted job_detatil_v3">
                                                                                {{ \Carbon\Carbon::parse($data['aproval_waiting']->date_start)->diffInDays(
                                                                                    \Carbon\Carbon::parse($data['aproval_waiting']->date_end),
                                                                                ) }}
                                                                                {{-- @nullOrValuedata($data['aproval_waiting']->date_end , 'End Date') --}}
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
                                                                            <p class="mb-0">Status</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p class="text-muted job_detatil_v3">
                                                                                Waiting For Approval
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    @endif


                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endforeach
                            </div>

                        </div>




                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- <div id="loadingModal" class="modal" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Downloading...</p>
                </div>
            </div>
        </div>
    </div> --}}

    @push('scripts')
        <script>
            function showModal() {
                var modal = document.getElementById('loadingModal');
                modal.style.display = 'block';
                modal.classList.add('show');
                modal.setAttribute('aria-modal', 'true');

                // Set a timeout to hide the modal after 5 seconds
                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                    modal.setAttribute('aria-modal', 'false');
                }, 8000); // Adjust the timeout as needed
            }
        </script>
    @endpush
@endsection
