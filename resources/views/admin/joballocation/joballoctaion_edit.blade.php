@extends('admin.layouts.master')

@section('contents')
    <style>
        select.form-select option.slected {
            background-color: #ff0000;
            /* Change this to your desired color */
            color: #ffffff;
            /* Change this to your desired text color */
        }

        .ui-widget.ui-widget-content {
            border: 1px solid #c5c5c5;
            border-radius: 5px;
            padding: 5px !important;
        }

        ul#ui-id-2 {
            position: relative;
            width: 300px;
            top: -275.531px;
            left: 40px;
        }

        #Product_code_col {
            display: block;
        }

        #serial_no_col {
            display: block;
        }

        #warranty_type_data {
            display: block;
        }

        #warranty_type_data .bluck_add {
            padding: 10px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 5px;
            margin-bottom: 0px;
            max-height: 133px;
        }
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12 align-items-center ">
                    <h1>Job Allocation</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Job Allocation</li>
                        </ol>
                    </nav>
                </div>

            </div>

        </div>
    </section>

    <section class="pt-3 section" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Edit Job Allocation</h5>
                                </div>

                            </div>
                        </div>
                        <div class="add_job">


                            <form action="{{ route('admin.joballocation.updateedit') }}" class="row g-3" method="POST">
                                @csrf
                                <div class="col-md-6">


                                    <div class="mb-3 form-floating">
                                        <select class="form-select" id="floatingService" aria-label="Service" autofocus
                                            name="type_services_id" required disabled>
                                            <option value="" disabled
                                                {{ empty($prdt_task[0]->type_services_id) ? 'selected' : '' }}>Please Choose
                                                Services</option>
                                            @foreach ($service as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($prdt_task[0]->type_services_id) && $prdt_task[0]->type_services_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->service_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <label for="floatingService">Type Of Service</label>
                                    </div>
                                </div>

                                <div id="Product_code_col" class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="Product_code"
                                            name="Product_code"placeholder="Enter Product Code" autocomplete="Product_code"
                                            value="{{ old('Product_code', $prdt_task[0]->product_add->product_code ?? '') }}"
                                            disabled>

                                        <label for="Product_code">Product Code</label>
                                    </div>
                                    <input type="hidden" class="form-control" id="Product_code_id"
                                        name="Product_code"placeholder="Enter Product Code" autocomplete="Product_code"
                                        value="{{ old('Product_code', $prdt_task[0]->id ?? '') }}">
                                </div>

                                <div id="serial_no_col" class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="serial_no" name="serial_no"
                                            placeholder="Serial no" autocomplete="serial_no"
                                            value="{{ old('serial_no', $prdt_task[0]->product_add->serial_number ?? '') }}">
                                        <label for="serial_no">Serial no</label>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Client_name" name="Client_name"
                                            placeholder="Company Name" required autocomplete="Client_name" autofocus
                                            value="{{ old('Client_name', $prdt_task[0]->product_add->client_pdt->office ?? '') }}"
                                            disabled>

                                        <label for="name">Company Name</label>

                                        <input type="hidden" id="client_id" name="client_id" readonly>
                                    </div>
                                </div>

                                <div id="Client_add_col" class="mb-0 col-md-12 me-1">
                                    <div id="Client_add" style="display: none" class="Client_add">
                                        <div class="form-floating " style="display:flex; flex-direction:row-reverse;">

                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Add Office Name"
                                                href="{{ route('admin.registration.clientdetails') }}">

                                                <i class="bi bi-plus-square"></i>

                                            </a>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Location_client"
                                            name="Location_client" placeholder="Location" required
                                            autocomplete="Location_client" autofocus
                                            value="{{ old('Location_client', $prdt_task[0]->product_add->client_pdt->location ?? '') }}"
                                            disabled>
                                        <label for="Location_client">Location</label>
                                    </div>
                                </div>
                                {{--  <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Email_client" name="Email_client"
                                            placeholder="Email" readonly>
                                        <label for="Email_client">Email</label>


                                    </div>
                                </div>  --}}
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone_client" name="phone_client"
                                            placeholder="Phone Number" required autocomplete="phone_client" autofocus
                                            value="{{ old('phone_client', $prdt_task[0]->product_add->client_pdt->phonenumber ?? '') }}"
                                            disabled>
                                        <label for="phone_client">Phone Number</label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control date-picker" id="Date_Schedule"
                                            name="Date_Schedule" placeholder="Date Of Schedule" required
                                            autocomplete="Date_Schedule"
                                            value="{{ old('Date_Schedule', $prdt_task[0]->date_of_schedule ?? '') }}">
                                        <label for="Date_Schedule">Date Of Schedule</label>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Equipment_job" name="Equipment"
                                            placeholder="Equipment Name" required autocomplete="Equipment"
                                            value="{{ old('Equipment', $prdt_task[0]->product_add->equip_pdt['Item_name'] ?? '') }}"
                                            disabled>


                                        <label for="name">Equipment Name</label>

                                        <input type="hidden" id="Equipment_id" name="Equipment_id" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Equipment_Brand" name="Brand"
                                            placeholder="Brand Name" required
                                            value="{{ old('Brand', $prdt_task[0]->product_add->equip_pdt['Brand'] ?? '') }}"
                                            disabled>
                                        <label for="Brand">Brand Name</label>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">



                                        <input type="text" class="form-control" id="Equipment_Model" name="Model"
                                            placeholder="Model Name" required
                                            value="{{ old('Model', $prdt_task[0]->product_add->equip_pdt['Model'] ?? '') }}"disabled>
                                        <label for="Model">Model Name</label>



                                    </div>
                                </div>





                                <div id='warranty_type_col' class="col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 form-floating">
                                                <select class="form-select" id="floatingWarranty" aria-label="Warranty"
                                                    name='warranty_type' required>
                                                    <option value="" disabled
                                                        {{ empty($prdt_task[0]->product_add->warranty->warranty_type) ? 'selected' : '' }}>
                                                        Please Choose Warranty
                                                    </option>
                                                    <option value="1"
                                                        {{ $prdt_task[0]->product_add->warranty->warranty_type == 1 ? 'selected' : '' }}>
                                                        Yes
                                                    </option>
                                                    <option value="2"
                                                        {{ $prdt_task[0]->product_add->warranty->warranty_type == 2 ? 'selected' : '' }}>
                                                        No
                                                    </option>
                                                </select>
                                                <label for="floatingWarranty">Warranty</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating" id="Warranty_date_select"
                                                style="{{ $prdt_task[0]->product_add->warranty->warranty_type == 1 ? '' : 'display: block;' }}">
                                                <input type="text" class="form-control" name="Warranty_month"
                                                    id="Warranty_date" placeholder="Enter the warranty period in months."
                                                    pattern="[0-9]+" title="Please enter only numbers"
                                                    value="{{ $prdt_task[0]->product_add->warranty->month ?? '' }}">
                                                <label for="Warranty_date">Enter the warranty period in months.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="warranty_type_data" class="col-md-6">
                                    <div class="bluck_add">
                                        <div class="row gy-3">
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0">Warranty:</p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0 text-muted Warranty_v3">
                                                    {{ $prdt_task[0]->product_add->warranty->warranty_type == 1 ? 'Yes' : 'No' }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0">Warranty Status:</p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0 text-muted Warranty_v3">
                                                    {{ $prdt_task[0]->product_add->warranty->warranty_type == 1 ? 'Active' : 'Inactive' }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0">Start Date:</p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0 text-muted Warranty_v3">
                                                    {{ $prdt_task[0]->product_add->warranty->Start_date ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0">End Date:</p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0 text-muted Warranty_v3">
                                                    {{ $prdt_task[0]->product_add->warranty->end_date ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0">Month:</p>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <p class="mb-0 text-muted Warranty_v3">
                                                    {{ $prdt_task[0]->product_add->warranty->month ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-floating">




                                        <textarea class="form-control" placeholder="Remarks" id="floatingRemarks" style="height: 133px;" name="Remarks"></textarea>
                                        <label for="floatingRemarks">Remarks</label>


                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                                </div>
                            </form>
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
        <script>
            $(document).ready(function() {
                $('#floatingService').change(function() {
                    toggleTextBox();
                });

                function toggleTextBox() {
                    var selectedValue = $('#floatingService option:selected').val();

                    var textBoxDiv = $('#Product_code_col');
                    var Client_add_col = $('#Client_add_col');
                    var clientNameInput = $('#Client_name');
                    var Equipment_job = $('#Equipment_job');
                    var warrantyDateInput = $('#floatingWarranty');
                    var Product_code = $('#Product_code');


                    if (selectedValue === '1') {
                        textBoxDiv.hide();
                        Client_add_col.show();
                        $('#warranty_type_col').show();
                        $('#view_equip_button_col').show();
                        $('#Product_code_col').show();
                        clientNameInput.prop('readonly', false);
                        Equipment_job.prop('readonly', false);
                        $('#serial_no_col').hide();
                        $('#warranty_type_data').hide();
                        warrantyDateInput.prop('required', true);
                        Product_code.prop('required', false);
                    } else {
                        textBoxDiv.show();
                        Client_add_col.hide();
                        $('#view_equip_button_col').hide();
                        $('#warranty_type_col').hide();
                        $('#serial_no_col').show();
                        $('#Product_code_col').show();
                        clientNameInput.prop('readonly', true);
                        Equipment_job.prop('readonly', true);
                        $('#warranty_type_data').show();
                        warrantyDateInput.prop('required', false);
                        Product_code.prop('required', true);
                    }
                }
                {{--  $("#Product_code").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/admin/joballocation/product_code',
                            data: {
                                term: request.term
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var resp = $.map(data, function(obj) {
                                    var currentDate = new Date();
                                    var formattedDate = currentDate.toISOString().split(
                                        'T')[0];
                                    var Equipment_itemName = obj.equip_pdt.Item_name ||
                                        'Please update Equipment Name into DB ';
                                    var Equipment_Brand_name = obj.equip_pdt.Brand !==
                                        null ? obj.equip_pdt.Brand :
                                        'Please update Brand Name into DB ';
                                    var equip_model = obj.equip_pdt.Model !== null ? obj
                                        .equip_pdt.Model :
                                        'Please update Model Name into DB ';
                                    var warranty_type_data = obj.warranty
                                        .warranty_type ==
                                        '1' ? 'Active' : 'InAcive';
                                    var warranty_check = obj.warranty.end_date >=
                                        formattedDate ? 'Active' : 'Expired';

                                    return {
                                        label: obj.product_code + ' , ' + obj.client_pdt
                                            .office + ' , ' + Equipment_itemName,
                                        productcode: obj.product_code,
                                        value: obj.id,
                                        serial_no: obj.serial_number,
                                        office: obj.client_pdt.office,
                                        phonenumber: obj.client_pdt.phonenumber,
                                        location: obj.client_pdt.location,
                                        email: obj.client_pdt.users.email,
                                        Date_Schedule: obj.created_at,
                                        Equipment_job: Equipment_itemName,
                                        Equipment_Brand: Equipment_Brand_name,
                                        Equipment_Model: equip_model,
                                        Equipment_item_id: obj.equip_pdt.item_id,

                                        warranty_type: warranty_type_data,
                                        warranty_check: warranty_check,
                                        Start_date: obj.warranty.Start_date,
                                        end_date: obj.warranty.end_date,
                                        month: obj.warranty.month,
                                        Product_id: obj.product_id,


                                    };
                                });
                                console.log(resp);
                                if (resp.length === 0) {
                                    resp.push({
                                        label: "No entries found",
                                        value: null
                                    });
                                }


                                response(resp);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        console.log(ui.item.Date_Schedule); // Debugging statement
                        // Update the input boxes with the selected client's name and ID
                        $("#Product_code").val(ui.item.productcode);
                        $("#serial_no").val(ui.item.serial_no);
                        $("#Client_name").val(ui.item.office);
                        $("#client_id").val(ui.item.value);
                        $("#Location_client").val(ui.item.location);
                        $("#Email_client").val(ui.item.email);
                        $("#phone_client").val(ui.item.phonenumber);
                        $("#Date_Schedule").val(new Date(ui.item.Date_Schedule).toISOString().split('T')[
                            0]);
                        $("#Equipment_job").val(ui.item.Equipment_job);
                        // $("#Equipment_id").val(ui.item.id);
                        $("#Equipment_Model").val(ui.item.Equipment_Model);
                        $("#Equipment_Brand").val(ui.item.Equipment_Brand);
                        $("#Equipment_item_id").val(ui.item.Equipment_item_id);
                        $('#warranty_type').text(ui.item.warranty_type);
                        $('#warranty_check').text(ui.item.warranty_check);
                        $('#start_date').text(ui.item.Start_date);
                        $('#end_date').text(ui.item.end_date);
                        $('#month').text(ui.item.month);
                        $('#Product_id').val(ui.item.Product_id);

                        return false; // Prevent the default behavior of setting the value in the input box
                    }
                });  --}}


            });


            $(document).ready(function() {

                {{--  $("#Client_name").autocomplete({
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
                        $("#Client_name").val(ui.item.office);
                        $("#client_id").val(ui.item.value);
                        $("#Location_client").val(ui.item.location);
                        $("#Email_client").val(ui.item.email);
                        $("#phone_client").val(ui.item.phonenumber);


                        return false; // Prevent the default behavior of setting the value in the input box
                    }
                });  --}}

                function showAddClientSection() {
                    $("#Client_add").show(); // Adjust the ID accordingly
                }

                function hideAddClientSection() {
                    $("#Client_add").hide(); // Adjust the ID accordingly
                }

                {{--  $("#Equipment_job").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/admin/joballocation/Equipment_job',
                            data: {
                                term: request.term
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var resp = $.map(data, function(obj) {
                                    var brand = obj.Brand !== null ? obj.Brand :
                                        'Please update Brand Name into DB ';
                                    var model = obj.Model !== null ? obj.Model :
                                        'Please update Model Name into DB ';
                                    var itemName = obj.Item_name ||
                                        'Please update Equipment Name into DB ';

                                    return {
                                        id: obj.id,
                                        Brand: brand,
                                        Model: model,
                                        item_id: obj.item_id,
                                        Item_name: obj.Item_name ||
                                            'Please update Equipment Name into DB',
                                        label: 'Brand: ' + brand + ' Model: ' + model +
                                            ' Name: ' + itemName,
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
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        // Update the input boxes with the selected client's name and ID
                        $("#Equipment_job").val(ui.item.Item_name);
                        $("#Equipment_id").val(ui.item.id);
                        $("#Equipment_Model").val(ui.item.Model);

                        $("#Equipment_Brand").val(ui.item.Brand);
                        $("#Equipment_item_id").val(ui.item.item_id);
                        $("#view_equip_button").attr('data-bs-whatever', ui.item.id);
                        return false; // Prevent the default behavior of setting the value in the input box
                    }
                });  --}}

                document.getElementById('floatingWarranty').addEventListener('change', function() {
                    var warrantyDateSelect = document.getElementById('Warranty_date_select');
                    var warrantyDateInput = document.getElementById('Warranty_date');

                    if (this.value === '1') { // '1' corresponds to the "Yes" option
                        warrantyDateSelect.style.display = 'block';
                        warrantyDateInput.required = true;
                    } else {
                        warrantyDateSelect.style.display = 'none';
                        warrantyDateInput.required = false;
                    }
                });

            });
        </script>

        <script>
            flatpickr(".date-picker", {
                dateFormat: "Y-m-d", // Matches "YYYY-MM-DD" format
                defaultDate: "{{ old('Date_Schedule', $prdt_task[0]->date_of_schedule ?? '') }}",
            });
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
@endsection
