@extends('admin.layouts.master')

@section('contents')
    <style>
        button.btn.bg-primary_expert {
            width: 50%;
        }

        .spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Product  Reports</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>

                        </ol>
                    </nav>
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
                                    <h5 class="card-title">Product List </h5>
                                </div>

                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>sl.no</th>
                                        <th>Product Code</th>
                                        <th>Serial Number</th>
                                        <th>Company Details</th>
                                        <th>Equipment</th>
                                        <th>Warranty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->product_code }}</td>
                                            <td>{{ $data->serial_number }}</td>
                                            <td>
                                                <ul>
                                                    <li>Comapany Name: {{ $data->client_pdt->office }} </li>
                                                    <li>Location:{{ $data->client_pdt->location }} </li>

                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>item_id : {{ $data->equip_pdt->item_id }} </li>
                                                    <li>Brand :{{ $data->equip_pdt->Brand }} </li>
                                                    <li>Model : {{ $data->equip_pdt->Model }}</li>
                                                    <li>Item name : {{ $data->equip_pdt->Item_name }}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    @php
                                                        $endDate = \Carbon\Carbon::parse($data->warranty->end_date);
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $isWarrantyValid = $endDate->gte($currentDate);
                                                    @endphp


                                                    <li>Warranty Staus : {{ $isWarrantyValid ? 'Yes' : 'No' }} </li>
                                                    <li>Start Date :{{ $data->warranty->Start_date }} </li>
                                                    <li>End Date : {{ $data->warranty->end_date }}</li>
                                                    <li>Month : {{ $data->warranty->month }}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="action_icon ">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="View"
                                                        href="{{ route('admin.joballocation.job_list_view', ['id' => encrypt($data->product_id)]) }}">
                                                        <button type="button" class="btn">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title=" Task View">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-whatever={{ $data->product_id }}
                                                            data-bs-target="#taskViewModal">
                                                            <i class="bi bi-journals"></i>
                                                        </button>
                                                    </a>
                                                    <a id="download_button" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Download"
                                                        href="{{ route('admin.joballocation.job_pdf_dowmload', ['id' => encrypt($data->product_id)]) }}">
                                                        <button type="button" class="btn">


                                                            <i class="bi bi-download"></i></i>

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
                </div>

            </div>
        </div>
    </section>
    <section id='assign'>
        <div class="modal fade" id="taskViewModal" tabindex="-1" aria-labelledby="taskViewModal" aria-hidden="true">
            <div class="modal-dialog 	modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Task List</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-5">

                        <div class="row">
                            <div class="table-responsive">
                                <table id="admin_table_task_view" class="table datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>sl.no</th>
                                            <th>Type Of Service</th>
                                            <th>Technician Name</th>
                                            <th>Date</th>
                                            <th>status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script></script>
        <script>
            $(document).ready(function() {
                $("#client_name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/admin/joballocation/find_client',
                            data: {
                                term: request.term
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var resp = $.map(data, function(obj) {



                                    return {
                                        label: obj.office + ', ' + obj.location,
                                        office: obj.office,
                                        value: obj.id,
                                        phonenumber: obj.phonenumber,
                                        location: obj.location,
                                        email: obj.users.email,


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
                                // Check if the entered term exists in the response
                                var termExists = resp.some(function(entry) {
                                    return entry.label.toLowerCase().includes(request
                                        .term.toLowerCase());
                                });

                                // If the term doesn't exist, show the "Add Client" section
                                if (!termExists) {
                                    showAddClientSection();
                                } else {
                                    hideAddClientSection();
                                }

                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        // Update the input boxes with the selected client's name and ID
                        $("#client_name").val(ui.item.office);

                        $("#client_name_id").val(ui.item.value);



                        return false; // Prevent the default behavior of setting the value in the input box
                    }
                });
            });
        </script>
    @endpush
@endsection
