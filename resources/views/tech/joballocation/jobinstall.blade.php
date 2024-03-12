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

                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign tp Job">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assign_to">
                               <i class="bi bi-lightning"></i>
                            </button>
                        </a>
                        @if($admin_id !== Auth::user()->id)
                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add My Job">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#taken_by" >
                                <i class="bi bi-person-fill-add"></i>
                            </button>
                        </a>
                        @endif


                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign tp Job">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assign_to" >
                                <i class="bi bi-person-fill-up"></i>
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



                            <div class="col-12">

                                <div id="job_deatail_v2" class="bluck_add mb-4">
                                    <div class="head-profie">
                                        <h5 class="card-title">Inspection Details</h5>

                                    </div>
                                    <div class="row gy-3">
<div class="col-6">
    <div class="di" style="border: 1px solid  red">
        <canvas id="signature-pad" width="400px" height="200px"  style="border: 1px solid #000; background-color: #f8f8f8;" ></canvas>
        <button id="save">Save</button>
        <button id="clear">Clear</button>
    </div>
</div>



                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);
        document.getElementById('clear').addEventListener('click', function () {
  signaturePad.clear();
});
        document.getElementById('save').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var data = signaturePad.toDataURL('image/svg+xml');
                // Send the SVG data to the server
                fetch('/save-signature', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ signature: data })
                }).then(response => {
                    if (response.ok) {
                        alert('Signature saved successfully.');
                    } else {
                        alert('Failed to save signature.');
                    }
                });
            }
        });
    </script>

    @endpush
@endsection
