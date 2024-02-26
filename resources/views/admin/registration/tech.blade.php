@extends('admin.layouts.master')

@section('contents')
    <div id="pagetitle" class="pagetitle">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-8  align-items-center ">
                <h1>Technician Registration</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Registration</li>
                    </ol>
                </nav>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button type="button" class="btn bg-primary_expert" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2"><i class="bi bi-plus me-1"></i><span class="add"> Add Technician
                    </span></button>
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
                                    <h5 class="card-title">Technician List</h5>
                                </div>

                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>
                                            First Name
                                        </th>
                                        <th>Last Name.</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($techuser as $techusers)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $techusers->firstname }}</td>
                                            <td>{{ $techusers->lastname }}</td>
                                            <td>
                                                {{ $techusers->users->email }}
                                            </td>
                                            <td>{{ $techusers->users->status == 1 ? 'Active' : 'Inactive' }} </td>
                                            <td>
                                                <div class="action_icon ">

                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="View" href="{{ route('admin.registration.techprofile', ['id' => encrypt($techusers->id)]) }}">
                                                    <button type="button" class="btn">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>

                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Password change">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#Password_change"
                                                            data-bs-whatever={{ $techusers->users->id }}>
                                                            <i class="bi bi-key"></i>
                                                        </button>
                                                    </a>
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Status Change">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#Status_change"
                                                            data-bs-whatever={{ $techusers->users->id }}>
                                                            @if ($techusers->users->status == 1)
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
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Technician</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.registration.techcreate') }}" class="row g-3" method="POST">
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
                                        name="Last_Name" required autocomplete="Last_Name" autofocus
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" name="Password"
                                        placeholder="Password">
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

                            <div class="text-center">

                                <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

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
                                    <label for="myDropdown">New Status</label>

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

    @foreach ($techuser as $posts)
        <section class="view" id="view">
            <div class="modal fade" id="view{{ $posts->id }}" tabindex="-1" aria-labelledby="viewLabel"
                aria-hidden="true">
                @include('admin.registration.tech_view', ['post' => $posts])

            </div>
        </section>
    @endforeach
    @if ($errors->any())
        @section('script')
            <script>
                $(document).ready(function() {
                    $('#exampleModal2').modal('show');
                });
            </script>
        @endsection
    @endif
    @push('scripts')
        @include('admin.registration.javascript');
    @endpush
@endsection
