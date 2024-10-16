@extends('admin.layouts.master')


@section('contents')
    <div id="pagetitle" class="pagetitle">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-8  align-items-center ">
                <h1>Client Registration</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Registration</li>
                    </ol>
                </nav>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button type="button" class="btn bg-primary_expert" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="bi bi-plus me-1"></i><span class="add"> Add New Client </span></button>
            </div>
        </div>

    </div>

    <section class="section pt-3" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Client List</h5>
                                </div>

                            </div>
                        </div>




                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>sl.no</th>
                                        <th>
                                            Office
                                        </th>
                                        <th>Location</th>
                                        <th>Email</th>
                                        <th>Sub Office list</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($clientData as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['client']->office }}</td>

                                            <td>{{ $data['client']->location }}</td>
                                            <td>
                                                {{ $data['client']->users->email }}
                                            </td>
                                            <td>
                                                {{ $data['suboffice_count'] }}
                                            </td>
                                            <td>{{ $data['client']->users->status == 1 ? 'Active' : 'Inactive' }} </td>
                                            <td>
                                                <div class="action_icon ">



                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                        href="{{ route('admin.registration.clientprofile', ['id' => encrypt($data['client']->id)]) }}">
                                                        <button type="button" class="btn">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Password change">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#Password_change"
                                                            data-bs-whatever={{ $data['client']->users->id }}>
                                                            <i class="bi bi-key"></i>
                                                        </button>
                                                    </a>

                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Status Change">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#Status_change"
                                                            data-bs-whatever={{ $data['client']->users->id }}>
                                                            @if ($data['client']->users->status == 1)
                                                                <i class="bi bi-check-circle"></i>
                                                            @else
                                                                <i class="bi bi-x-circle"></i>
                                                            @endif
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
    <section class="admin_registration_modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Client</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.registration.clientcreate') }}" class="row g-3" method="POST">
                            @csrf


                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingfirstName"
                                        placeholder="First Name" name="First_Name" required autocomplete="First_Name"
                                        autofocus value="{{ old('First_Name') }}">
                                    <label for="floatingfirstName">First Name</label>
                                    @error('First_Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingLastName" placeholder="Last Name"
                                        name="Last_Name" autocomplete="Last_Name" required autofocus
                                        value="{{ old('Last_Name') }}">
                                    <label for="floatingLastName">Last Name</label>
                                    @error('Last_Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingEmail" name="Email"
                                        placeholder="Email" required autocomplete="Email" autofocus
                                        value="{{ old('Email') }}">
                                    <label for="floatingEmail">Email</label>
                                    @error('Email')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div id="emailAvailabilityMessage"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" name="Password"
                                        placeholder="Password" required>
                                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                    </span>
                                    <label for="floatingPassword">Password</label>

                                    @error('Password')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingofficename"
                                            name="Office_Name" placeholder="Company Name" required
                                            autocomplete="Office_Name" autofocus value="{{ old('Office_Name') }}">
                                        <label for="floatingofficename">Company Name</label>
                                        @error('Office_Name')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingLocation"
                                            name="Main_Location" placeholder="Location" required
                                            autocomplete="Main_Location" autofocus value="{{ old('Main_Location') }}">
                                        <label for="floatingPhone">Location</label>
                                        @error('Main_Location')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingPhone"
                                            name="Phone_number" placeholder="Phone Number" required
                                            autocomplete="Phone_number" autofocus value="{{ old('Phone_number') }}">
                                        <label for="floatingPhone">Phone Number</label>
                                        @error('Phone_number')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingStatus" aria-label="Status">

                                        <option value="1" selected>Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    <label for="floatingStatus">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="add_office">
                                    <h6 class="" id="">Add Sub Office details:</h6>

                                    <button type="button" name="add" id="dynamic-ar" class="btn  btn-success "><i
                                            class="bi bi-plus-lg" style="color:white"></i> </button>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>Sub Company Name</th>
                                        <th>Location</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>

                                    </tr>
                                </table>
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

    {{-- @foreach ($clientData as $posts)
<section class="view" id="view">
    <div class="modal fade" id="view{{ $posts['client']->id }}" tabindex="-1" aria-labelledby="viewLabel"
        aria-hidden="true">
        @include('admin.registration.client_view', ['post' => $posts])

    </div>
</section>
@endforeach --}}


    <section class="view" id="view">
        <div class="modal fade" id="Password_change" tabindex="-1" aria-labelledby="Password_change"
            aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Password Change</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.passwordupdate') }}" class="row g-3" method="POST">

                            @csrf
                            <input type="text" class="form-control" id="recipient-name" name="id" hidden>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                        name="Name" required autocomplete="Nmae" autofocus disabled>
                                    <label for="floatingName">Name</label>
                                    @error('Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="Email" class="form-control" id="floatingEmail" placeholder="Email"
                                        name="Email" required autocomplete="Last_Name" autofocus disabled>
                                    <label for="floatingEmail">Email</label>
                                    @error('Last_Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingpasswordchanged"
                                        name="password" placeholder="Password" required autocomplete="password"
                                        autofocus>
                                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <i class="bi bi-eye-slash" id="togglePasswordchanged"
                                            style="cursor: pointer;"></i>
                                    </span>
                                    <label for="floatingpassword"> Password</label>
                                    @error('Email')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="ConfirmPassword"
                                        name="ConfirmPassword" placeholder="ConfirmPassword">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <div id="passwordHelp" class="form-text"></div>

                                </div>
                            </div>
                            <div class="text-center">

                                <button type="submit" id='UpdatePassword'
                                    class="btn bg-primary_expert btn-style-password">Update
                                    Password</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="view" id="view">
        <div class="modal fade" id="Status_change" tabindex="-1" aria-labelledby="Status_change" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Status Change</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.updateStatus') }}" class="row g-3" method="POST">

                            @csrf
                            <input type="text" class="form-control" id="recipient-name" name="id" hidden>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                        name="Name" required autocomplete="Nmae" autofocus disabled>
                                    <label for="floatingName">Name</label>
                                    @error('Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="Email" class="form-control" id="floatingEmail" placeholder="Email"
                                        name="Email" required autocomplete="Last_Name" autofocus disabled>
                                    <label for="floatingEmail">Email</label>
                                    @error('Last_Name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="statusName" name="statusName"
                                        placeholder="StatusName" required autocomplete="statusName" disabled autofocus>
                                    <label for="statusName">Status</label>
                                    @error('statusName')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select id="myDropdown" class="form-select" name="statusupdate"></select>
                                    <label for="myDropdown">Status</label>

                                </div>
                            </div>
                            <div class="text-center">

                                <button type="submit" id='updateStatus'
                                    class="btn bg-primary_expert btn-style-password">Update Status</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <a href="#" title="" class="add-friend">Add Friend</a>
    @if ($errors->any())
        @section('script')
            <script>
                $(document).ready(function() {
                    $('#exampleModal').modal('show');
                });
            </script>
        @endsection
    @endif
    @push('scripts')
        <script>
            $(document).ready(function() {
                var emailInput = $('#floatingEmail');

                emailInput.on('change', function() {
                    checkEmailAvailability_floatingEmail();
                });

                function isValidEmail(email) {
                    // Regular expression for a basic email validation
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                function checkEmailAvailability_floatingEmail() {
                    var email = emailInput.val();

                    // Validate the email format
                    if (isValidEmail(email)) {


                        $.ajax({
                            url: '/admin/check-email-availability-client/',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                email: email
                            },
                            success: function(data) {
                                var availabilityMessage = $('#emailAvailabilityMessage');

                                if (data.exists) {

                                    availabilityMessage.html(
                                        'Email already exists. Please choose a different email.');
                                } else {
                                    availabilityMessage.html('');
                                }
                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                    } else {
                        var availabilityMessage = $('#emailAvailabilityMessage');
                        availabilityMessage.html('Invalid email format');

                        // You can display an error message or take other appropriate actions
                    }
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                let i = 0;
                const existingEmails = [];

                function validateEmail(email) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                function validatePassword(password) {
                    const passwordRegex = /^[a-z]{4,}$/;
                    return passwordRegex.test(password);
                }

                function handlePasswordInput(passwordInput) {
                    const passwordValue = passwordInput.val();
                    const errorMessage = passwordInput.closest('td').find('.error-message');

                    errorMessage.text(validatePassword(passwordValue) ? '' :
                        'Password must be at least 4 characters '
                    );
                }

                function addNewRow() {
                    ++i;
                    const newRow = $(`<tr>
                            <td><input type="text" id="subOfficeName_${i}" name="officedetails[${i}][Sub_Office_Name]" placeholder="Sub Company Name" class="form-control Sub_Office_Name-input" required /><span class="error-message"></span></td>
                            <td><input type="text" id="location_${i}" name="officedetails[${i}][Location]" placeholder="Location" class="form-control" required /></td>
                            <td><input type="email" id="emailOffice_${i}" name="officedetails[${i}][email_office]" placeholder="Email" class="form-control email-input" required /><span class="error-message"></span></td>
                            <td>
            <div class="position-relative">
                <input type="password" id="passwordOffice_${i}" name="officedetails[${i}][password_office]" placeholder="Password" class="form-control" required />
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
                    <i class="bi bi-eye-slash" id="togglePassword_${i}" style="cursor: pointer;"></i>
                </span>
            </div>
            <span class="error-message"></span>
        </td>
                            <td><button type="button" class="btn btn-danger remove-input-field" data-index="${i}"><i class="bi bi-x-lg" style="color:white;"></i></button></td>
                        </tr>`);

                    newRow.find('input[type="email"]').on('input', function() {
                        handleEmailInput($(this));
                    });

                    newRow.find('input[type="password"]').on('input', function() {
                        handlePasswordInput($(this));
                    });
                    newRow.find(`#togglePassword_${i}`).on('click', function() {
                        const passwordField = newRow.find(`#passwordOffice_${i}`);
                        const passwordFieldType = passwordField.attr('type') === 'password' ? 'text' :
                            'password';
                        passwordField.attr('type', passwordFieldType);
                        $(this).toggleClass('bi-eye bi-eye-slash');
                    });

                    $("#dynamicAddRemove").append(newRow);
                }

                function handleEmailInput(emailInput) {
                    const newEmailValue = emailInput.val();
                    const errorMessageElement = emailInput.siblings('.error-message');


                    if (existingEmails.includes(newEmailValue)) {
                        errorMessageElement.text('Email already exists. Please choose a different email.');
                    } else {
                        errorMessageElement.text('');
                        const index = emailInput.attr('id').split('_')[1];
                        existingEmails[index] = newEmailValue;

                        // Check email availability
                        checkAndHandleEmailAvailability(newEmailValue, emailInput.attr('id'));
                    }
                }

                function checkAndHandleEmailAvailability(email, id) {
                    checkEmailAvailability(email)
                        .then(function(data) {
                            if (!data.exists) {
                                handleExistingEmailSuccess(id);
                            } else {
                                handleExistingEmailError(id);
                            }
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                }

                $("#dynamic-ar").on('click', function() {
                    const newEmailValue = $('#floatingEmail').val();
                    const id = `emailOffice_${i}`;

                    if (existingEmails.length === 0) {
                        checkAndHandleEmailAvailability(newEmailValue, id);
                        existingEmails.push(newEmailValue);
                        addNewRow();
                    } else {
                        checkAndHandleEmailAvailability(newEmailValue, id);
                        existingEmails.push(newEmailValue);
                        addNewRow();
                    }
                });

                $("#dynamicAddRemove").on('input', 'input[name^="officedetails"][name$="[email_office]"]', function() {
                    handleEmailInput($(this));
                });

                $(document).on('click', '.remove-input-field', function() {
                    const indexToRemove = $(this).data('index');
                    existingEmails.splice(indexToRemove, 1);
                    $(this).parents('tr').remove();
                });

                $("#submitForm").on('click', function() {
                    // Add validation before submitting the form
                    if (validateForm()) {
                        alert('Form submitted successfully!');
                        // Add your form submission logic here
                    } else {
                        alert('Please fill in all required fields in each row.');
                    }
                });

                function validateForm() {
                    let isValid = true;
                    $("#dynamicAddRemove input[type='email']").each(function() {
                        if ($(this).val() === '') {
                            isValid = false;
                            return false; // Break out of the loop if any field is empty
                        }
                    });

                    return isValid;
                }

                function checkEmailAvailability(email) {
                    return new Promise(function(resolve, reject) {
                        $.ajax({
                            url: '/admin/check-email-availability-client/',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                email: email
                            },
                            success: function(data) {
                                resolve(data);
                            },
                            error: function(error) {
                                console.error('Error:', error);
                                reject(error);
                            }
                        });
                    });
                }

                function handleExistingEmailError(id) {
                    const errorMessageElement = $('#' + id).siblings('.error-message');
                    errorMessageElement.text('Email already exists. Please choose a different email.');


                }

                function handleExistingEmailSuccess(id) {
                    const errorMessageElement = $('#' + id).siblings('.error-message');
                    errorMessageElement.text('');

                }
            });
        </script>

        @include('admin.registration.javascript');
    @endpush
@endsection
