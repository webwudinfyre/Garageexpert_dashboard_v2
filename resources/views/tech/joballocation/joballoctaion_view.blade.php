@extends('tech.layouts.master')

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
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12  align-items-center ">
                    <h1>Job Allocation</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('tech.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Job Allocation</li>
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
                                    <h5 class="card-title">Add Job Allocation</h5>
                                </div>

                            </div>
                        </div>
                        <div class="add_job">



                            <form action="{{ route('tech.joballocation.update') }}" class="row g-3">

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingService" aria-label="Service" autofocus name="type_services_id" required>
                                            <option value="" disabled selected >Please Choose Services</option>

                                            @foreach ($service as $item)
                                                <option value="{{ $item->id }}"> <span class="service_option_size">
                                                        {{ $item->service_name }} </span></option>
                                            @endforeach

                                        </select>
                                        <label for="floatingService">Type Of Service</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Client_name" name="Client_name"
                                            placeholder="Office Name" required autocomplete="Client_name" autofocus
                                            value="{{ old('Client_name') }}">
                                        <label for="name">Office Name</label>

                                        <input type="hidden" id="client_id" name="client_id" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-0 me-1">
                                    <div id="Client_add" style="display: none" class="Client_add">
                                        <div class="form-floating " style="display:flex; flex-direction:row-reverse;">

                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Add Office Name"
                                                href="{{ route('tech.registration.clientdetails') }}">

                                                <i class="bi bi-plus-square"></i>

                                            </a>




                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Location_client"
                                            name="Location_client" placeholder="Location" readonly>
                                        <label for="Location_client">Location</label>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="Email_client" name="Email_client"
                                            placeholder="Email" readonly>
                                        <label for="Email_client">Email</label>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" id="phone_client" name="phone_client"
                                            placeholder="Phone Number" readonly>
                                        <label for="phone_client">Phone Number</label>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="date" class="form-control" id="Date_Schedule" name="Date_Schedule" required
                                            placeholder="Date Of Schedule">
                                        <label for="Date_Schedule">Date Of Schedule</label>


                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="Equipment" id="Equipment_job"
                                            placeholder="Equipment Name" required>
                                        <label for="name">Equipment Name</label>

                                        <input type="hidden" id="Equipment_id" name="Equipment_id" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="Brand" id="Equipment_Brand"
                                            placeholder="Brand Name" readonly>
                                        <label for="Brand">Brand Name</label>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="Model" id="Equipment_Model"
                                            placeholder="Model Name" readonly>
                                        <label for="Model">Model Name</label>



                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="Equipment_Id"
                                            id="Equipment_item_id" placeholder="Equipment Id" readonly>
                                        <label for="Equipment_Id">Model Name</label>



                                    </div>
                                </div>

                                <div class="col-md-12 mb-0">
                                    <div class="form-floating " style="display:flex; flex-direction:row-reverse;">

                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                            <button type="button" id="view_equip_button" class="btn"
                                                data-bs-toggle="modal" data-bs-target="#view_equip">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </a>




                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="floatingWarranty" aria-label="Warranty" name='warranty_type'
                                                    required>
                                                    <option value="" disabled selected >Please Choose warranty</option>
                                                    <option value="1"> Yes</option>
                                                    <option value="2"> No</option>

                                                </select>
                                                <label for="floatingWarranty">Warranty</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating" id="Warranty_date_select" style="display: none;">

                                                <input type="text" class="form-control" name="Warranty_month"
                                                    id="Warranty_date" placeholder="Enter the warranty period in months."
                                                    pattern="[0-9]+" title="Please enter only numbers">
                                                <label for="Warranty_date">Enter the warranty period in months.</label>



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

    <section class="view" id="view">
        <div class="modal fade" id="view_equip" tabindex="-1" aria-labelledby="view_equip" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Equipment Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tech.equipment.update') }}" class="row g-3" method="POST">
                            @csrf

                            <input type="text" class="form-control" id="recipient_name" name="id" hidden>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingitem_id"
                                        placeholder="Item ID" name="item_id" required autocomplete="item_id" autofocus
                                        value="{{ old('item_id') }}" disabled>
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
                                    <input type="text" class="form-control" id="floatingBrand"
                                        placeholder="Brand Name" name="Brand" required autocomplete="Brand" autofocus
                                        value="{{ old('Brand') }}">
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
                                        placeholder="Item Name" name="Item_name" required autocomplete="Item_name"
                                        autofocus value="{{ old('Item_name') }}">
                                    <label for="floatingItem_name">Item Name</label> --}}
                                    <textarea class="form-control" name="Item_name" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
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

                                    <input type="text" class="form-control" id="floatingModel" placeholder="Model"
                                        name="Model" required autocomplete="Model" autofocus
                                        value="{{ old('Model') }}">
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
                        </form>
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

                $("#Client_name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/tech/joballocation/find_client',
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
                });

                function showAddClientSection() {
                    $("#Client_add").show(); // Adjust the ID accordingly
                }

                function hideAddClientSection() {
                    $("#Client_add").hide(); // Adjust the ID accordingly
                }

                $("#Equipment_job").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/tech/joballocation/Equipment_job',
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
                });

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
    @endpush
@endsection
