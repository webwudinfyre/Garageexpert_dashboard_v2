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

        .signature-container {
            width: 100%;
            max-width: 350px;
            /* Set the maximum width as needed */
            margin: 0 auto;
            /* Center the container */
        }

        .signature-pad {
            width: 100%;
            max-width: 100%;
            /* Set the maximum width */
        }

        .save_sig {
            display: flex;
            justify-content: flex-end;
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

                {{-- <div class="col-4 d-flex justify-content-end">
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
                        @if ($admin_id !== Auth::user()->id)
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add My Job">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#taken_by">
                                    <i class="bi bi-person-fill-add"></i>
                                </button>
                            </a>
                        @endif


                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign tp Job">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assign_to">
                                <i class="bi bi-person-fill-up"></i>
                            </button>
                        </a>


                    </div>
                </div> --}}

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
                                        <h5 class="card-title">{{ $type_services }} Details</h5>

                                    </div>
                                    <form id="signature-form" action="/tech/save-signature" method="post">
                                        @csrf <!-- Laravel CSRF token -->
                                        <div class="row gy-3">

                                            <div class="col-md-6">
                                                <div class="row gy-3">
                                                    @if (empty($data->serial_number))
                                                        <div class="col-12">
                                                            <div class="form-floating">

                                                                <input type="text" class="form-control" id="Serial_no"
                                                                    name="Serial_no" placeholder="Serial no" required
                                                                    autocomplete="Serial_no" autofocus
                                                                    value="{{ $data->serial_number }}">
                                                                <label for="Serial no">Serial no</label>

                                                                @error('Serial_no')
                                                                    <div class="alert-color" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="col-12">
                                                        <div class="form-floating">
                                                            <textarea class="form-control" placeholder="Remarks" id="floatingRemarks" style="height: 200px;" name="Remarks"
                                                                required></textarea>
                                                            <label for="floatingRemarks">Remarks</label>


                                                        </div>
                                                    </div>

                                                    @php
                                                        $isInstallation = $type_services === 'Installation';
                                                    @endphp

                                                    @if ($type_services !== 'Installation')
                                                        <div class="col-12">
                                                            <fieldset class="row mb-3 ms-.5 gy-3">
                                                                <div class="col-12">
                                                                    <legend class="col-form-label col-sm-12 pt-0">Quotation
                                                                        Product</legend>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="Quotation_value" id="gridRadios1"
                                                                            value="1" checked>
                                                                        <label class="form-check-label" for="gridRadios1">
                                                                            Send Quotation
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="Quotation_value" id="gridRadios2"
                                                                            value="2">
                                                                        <label class="form-check-label" for="gridRadios2">
                                                                            Don't Send Quotation
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </fieldset>
                                                        </div>
                                                    @endif


                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                        <table id="dynamicTable" class="table table-striped">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>

                                                                <th>Action</th>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="addmore[0][name_mail]" placeholder="Enter  Name" class="form-control" /></td>
                                                                <td><input type="text" name="addmore[0][email_mail]" placeholder="Enter Email" class="form-control" /></td>

                                                                <td><button type="button" name="add" id="add" class="btn "><i class="bi bi-plus-square"></i></button></td>
                                                            </tr>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row  gy-3">
                                                    <div class="col-12">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="name_client"
                                                                name="name_client" placeholder="Name">
                                                            <label for="name_client">Name</label>


                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="row gy-3">
                                                            <div class="col-md-12">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control"
                                                                        id="Postion" name="Postion"
                                                                        placeholder="Postion" required>
                                                                    <label for="Postion_client">Postion</label>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control"
                                                                        id="Email" name="Email_client"
                                                                        placeholder="Email" required>
                                                                    <label for="Email_client">Email</label>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control"
                                                                        id="Phone" name="phone_client"
                                                                        placeholder="Phone" required>
                                                                    <label for="phone_client">Phone</label>
                                                                </div>


                                                            </div>


                                                            <div class="col-md-12 ">
                                                                <div class="row gy-3">
                                                                    <div class="col-6">
                                                                        <p class="mb-0">Signature </p>

                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="signature-container">
                                                                            <canvas id="signature-pad"
                                                                                class="signature-pad"
                                                                                style="border: 1px solid #b9b7b7; background-color: #f8f8f8; border-radius:10px"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            </div>


                                                        </div>



                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <hr>
                                                <div class="save_sig">
                                                    <input type="hidden" name="signature" id="signature_data">
                                                    <input type="hidden" name="producttask_id" id="producttask_id"
                                                        value="{{ $prdt_task_id }}">

                                                    <button type="submit" class="btn bg-primary_expert btn-style"
                                                        id="save-signature">Submit</button>

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



    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
        <script type="text/javascript">
            var i = 0;

            $("#add").click(function() {

                ++i;

                $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i +
                    '][name_mail]" placeholder="Enter Name" class="form-control" /></td><td><input type="text" name="addmore[' +
                    i +
                    '][email_mail]" placeholder="Enter Email" class="form-control" /></td><td><button type="button" class="btn  remove-tr"><i class="bi bi-trash"></i></button></td></tr>'
                    );
            });

            $(document).on('click', '.remove-tr', function() {
                $(this).parents('tr').remove();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var isInstallation = {{ $isInstallation ? 'true' : 'false' }};
                var radios = document.querySelectorAll('input[type="radio"][name="gridRadios"]');

                if (!isInstallation) {
                    radios.forEach(function(radio) {
                        radio.setAttribute('required', 'required');
                    });
                }
            });


            document.addEventListener('DOMContentLoaded', () => {
                const canvas = document.getElementById('signature-pad');
                const signaturePad = new SignaturePad(canvas);
                console.log(signature_data);
                // Listen for the 'Save Signature' button click
                document.getElementById('save-signature').addEventListener('click', () => {
                    // Get the signature data as an SVG
                    const signatureData = signaturePad.toDataURL('image/svg+xml');
                    // Set the signature data in the hidden input field
                    document.getElementById('signature_data').value = signatureData;
                });


            });
        </script>
    @endpush
@endsection
