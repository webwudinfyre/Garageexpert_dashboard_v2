@extends('admin.layouts.master')

@section('contents')
    <style>
        .sub_office_view {
            display: flex;
            justify-content: space-between;
            padding: 15px 0px 0px 0px;
        }

        .sub_office_view .card-title {
            padding: 0px 0px !important;
        }
        #collapseTwo .add_suboffice_profile
        {
            margin: 20px 0px;
        }
        #collapseTwo .add_suboffice_profile i{
            color: white;

}
    </style>
    <div id="pagetitle" class="pagetitle">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-8  align-items-center ">
                <h1>Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        @if ($Adminusers->suboffice === 'main')
                        <li class="breadcrumb-item active">Client Profile</li>
                        @else
                        <li class="breadcrumb-item active"><a  href="{{ route('admin.registration.clientprofile', ['id' => encrypt($Adminusers->suboffice)]) }}">{{ $officemain }} Profile </a></li>
                        <li class="breadcrumb-item active">Sub Office Profile</li>
                        @endif
                    </ol>
                </nav>
            </div>

        </div>

    </div>

    <section id="profile">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="edit-profile">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">

                            </a>
                        </div>
                        @if ($Adminusers->avatar)
                            <img src="{{ asset('storage/images/images/' . $Adminusers->avatar) }}" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px;">
                        @else
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        @endif


                        <h5 class="my-2">@nullOrValue($Adminusers->users->name, 'Name')</h5>
                        <p class="text-muted mb-1">@nullOrValue($Adminusers->location, 'Location')</p>
                        <p class="text-muted mb-4">@nullOrValue($Adminusers->Address, 'Address')</p>
                        <div class="d-flex justify-content-center mb-2">

                            <button type="button" class="btn bg-primary_expert ms-1">Message</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body ">
                        <div class="head-profie">
                            <h5 class="card-title">Social Media links</h5>
                            <div class="edit-profile">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#edit_social_Media">
                                        <i class="bi bi-pencil-square"></i>
                                    </button></a>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="bi bi-globe bi-lg text-warning"><span class="icon-name">Websites</span></i>
                                <p class="mb-0">@nullOrValue($Adminusers->Website, 'Website Address')</p>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="bi bi-twitter-x bi-lg"><span class="icon-name">X</span></i>
                                <p class="mb-0">@nullOrValue($Adminusers->instagram, 'Instagram')</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="bi bi-instagram bi-lg"><span class="icon-name">Instagram </span></i>
                                <p class="mb-0">@nullOrValue($Adminusers->twitter, 'X')</p>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="bi bi-facebook bi-lg"><span class="icon-name">Facebook</span></i>
                                <p class="mb-0">@nullOrValue($Adminusers->facebook, 'Facebook')</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="head-profie">
                            <h5 class="card-title">Basic Details</h5>
                            <div class="edit-profile">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#Basic_details"><i class="bi bi-pencil-square"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->firstname, 'First Name') @nullOrValue($Adminusers->lastname, 'Last Name')</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->users->email, 'Email')</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->phonenumber, 'Phone')</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Company Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->office, 'Office')</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Location</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->location, 'Location')</p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@nullOrValue($Adminusers->Address, 'Address')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($Adminusers->suboffice === 'main')
                        <div class="col-md-12">

                            <div class="card mb-4 ">
                                <div class="card-body">
                                    <div class="sub_office_view">
                                        <h5 class="card-title">Sub Office</h5>
                                        <div class="sub_office_btn">
                                            <button class="btn bg-primary_expert collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                View All
                                            </button>
                                        </div>

                                    </div>


                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="add_suboffice_profile">
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn bg-primary_expert" data-bs-toggle="modal" data-bs-target="#add_sub_office_profile"><i
                                                        class="bi bi-plus me-1"></i><span class="add">Add Sub Office</span></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table id="admin_table" class="table datatable table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>sl.no</th>
                                                            <th>Name</th>
                                                            <th>Office</th>
                                                            <th>Location</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($sub_office as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data->users->name }}</td>
                                                                <td>{{ $data->office }}</td>
                                                                <td>{{ $data->location }}</td>
                                                                <td>{{ $data->users->email }}</td>
                                                                <td>{{ $data->phonenumber }}</td>
                                                                <td>{{ $data->users->status == 1 ? 'Active' : 'Inactive' }}
                                                                </td>

                                                                <td>
                                                                    <div class="action_icon ">
                                                                        <a data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" data-bs-title="View"
                                                                            href="{{ route('admin.registration.clientprofile', ['id' => encrypt($data->id)]) }}">
                                                                            <button type="button" class="btn">
                                                                                <i class="bi bi-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                        <a data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            data-bs-title="Password change">
                                                                            <button type="button" class="btn"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#Password_change"
                                                                                data-bs-whatever={{ $data->users->id }}>
                                                                                <i class="bi bi-key"></i>
                                                                            </button>
                                                                        </a>

                                                                        <a data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            data-bs-title="Status Change">
                                                                            <button type="button" class="btn"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#Status_change"
                                                                                data-bs-whatever={{ $data->users->id }}>
                                                                                @if ($data->users->status == 1)
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

                        </div>
                    @endif

                    <div class="col-md-12">
                        {{-- <div class="card  mb-4 ">

                            <div class="card-body">
                                <h5 class="card-title">Over view</h5>

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-home" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-contact" type="button" role="tab"
                                            aria-controls="contact" aria-selected="false">Contact</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabContent">
                                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora
                                        libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem
                                        eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
                                    </div>
                                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia.
                                        Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi
                                        quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut
                                        laboriosam voluptatum dicta.
                                    </div>
                                    <div class="tab-pane fade" id="bordered-contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque.
                                        Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit
                                        molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                                    </div>
                                </div><!-- End Bordered Tabs -->

                            </div>

                        </div> --}}
                    </div>

                </div>
            </div>
        </div>

        <section class="edit_social">
            <div class="modal fade" id="edit_social_Media" tabindex="-1" aria-labelledby="edit_social_Media"
                aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Social Media links</h1>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="bi bi-x"></i></button>
                        </div>
                        <div class="modal-body">
                            <form
                                action="{{ route('admin.registration.client.profilecreatesocial', ['id' => encrypt($Adminusers->id)]) }}"
                                class="row g-3" method="post">
                                @csrf


                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingwebsite"
                                            placeholder="Website Address" name="Website" required autocomplete="website"
                                            autofocus value="@nullOrValuenostyle($Adminusers->Website, 'Website Address')">
                                        <label for="floatingwebsite">Website Address</label>
                                        @error('website')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatinginstagram"
                                            placeholder="Instagram" name="instagram" required autocomplete="instagram"
                                            autofocus value="@nullOrValuenostyle($Adminusers->instagram, 'Instagram')">
                                        <label for="floatinginstagram">Instagram</label>
                                        @error('instagram')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingtwitter" placeholder="X"
                                            name="twitter" required autocomplete="twitter" autofocus
                                            value="@nullOrValuenostyle($Adminusers->twitter, 'X')">
                                        <label for="floatingtwitter">X</label>
                                        @error('twitter')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingfacebook"
                                            placeholder="Facebook" name="facebook" required autocomplete="facebook"
                                            autofocus value="@nullOrValuenostyle($Adminusers->facebook, 'Facebook')">
                                        <label for="floatingtfacebook">Facebook</label>
                                        @error('facebook')
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

        <section class="Basic_details">
            <div class="modal fade" id="Basic_details" tabindex="-1" aria-labelledby="Basic_etails"
                aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Basic_etails</h1>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="bi bi-x"></i></button>
                        </div>
                        <div class="modal-body">
                            <form
                                action="{{ route('admin.registration.client.profilebasic_details', ['id' => encrypt($Adminusers->id)]) }}"
                                class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6 ">
                                    <div class="form-floating text-center ">

                                        @if ($Adminusers->avatar)
                                            <img src="{{ asset('storage/images/images/' . $Adminusers->avatar) }}"
                                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        @else
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        @endif



                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-sm-4 d-flex text-center">
                                            <label for="inputNumber" class="col-form-label">Change Image</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input type="file" name="image" id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="row  g-3 mt-0.9">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingfirstName"
                                                    placeholder="First Name" name="First_Name" required
                                                    autocomplete="First_Name" autofocus value="@nullOrValuenostyle($Adminusers->firstname, 'First Name')">
                                                <label for="floatingfirstName">First Name</label>
                                                @error('First_Name')
                                                    <div class="alert-color" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingLastName"
                                                    placeholder="Last Name" name="Last_Name" required
                                                    autocomplete="Last_Name" autofocus value="@nullOrValuenostyle($Adminusers->lastname, 'Last Name')">
                                                <label for="floatingLastName">Last Name</label>
                                                @error('Last_Name')
                                                    <div class="alert-color" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="floatingEmail"
                                                    name="Email" placeholder="Email" required autocomplete="Email"
                                                    autofocus value="@nullOrValuenostyle($Adminusers->users->email, 'Email')">
                                                <label for="floatingEmail">Email</label>
                                                @error('Email')
                                                    <div class="alert-color" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>


                                    </div>



                                </div>


                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingPhone"
                                                name="Phone_number" placeholder="Phone Number" required
                                                autocomplete="Phone_number" autofocus value="@nullOrValuenostyle($Adminusers->phonenumber, 'Phone')">
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
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingAddress"
                                                name="Address" placeholder="Address" required autocomplete="Address"
                                                autofocus value="@nullOrValuenostyle($Adminusers->Address, 'Address')">
                                            <label for="floatingAddress">Address</label>
                                            @error('Address')
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
                                            <input type="text" class="form-control" id="floatingPosition"
                                                name="Postion" placeholder="Position" required autocomplete="Position"
                                                autofocus value="@nullOrValuenostyle($Adminusers->Position, 'Position')">
                                            <label for="floatingPosition">Position</label>
                                            @error('Position')
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
                                            <select class="form-select" id="floatinggender" name="Gender" required>
                                                <option value="@nullOrValuenostyle($Adminusers->Gender, 'Gender')" @if ($Adminusers->Gender == '')
                                                    selected
                                                    @endif>@nullOrValuenostyle($Adminusers->Gender, 'Gender')</option>
                                                <option value="male" @if ($Adminusers->Gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($Adminusers->Gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            <label for="floatingPosition">Gender</label>
                                            @error('gender')
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
                                            <input type="text" class="form-control" id="floatingOffice"
                                                name="office" placeholder="Office" required autocomplete="office"
                                                autofocus value="@nullOrValuenostyle($Adminusers->office, 'office')">
                                            <label for="floatingOffice">Office</label>
                                            @error('office')
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
                                            <input type="text" class="form-control" id="floatinglocation"
                                                name="location" placeholder="location" required autocomplete="location"
                                                autofocus value="@nullOrValuenostyle($Adminusers->location, 'Location')">
                                            <label for="floatinglocation">Location</label>
                                            @error('Position')
                                                <div class="alert-color" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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

    <section class="admin_registration_modal">
        <div class="modal fade" id="add_sub_office_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub Office</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.registration.clientcreate.suboffice',['id' => encrypt($Adminusers->id)]) }}" class="row g-3" method="POST">
                            @csrf


                            <div class="col-md-6 d-flex align-items-center">
                                <div class="add_office">
                                    <h6 class="" id="">Add Sub Office details:</h6>

                                    <button type="button" name="add" id="dynamic-ar" class="btn  btn-success "><i
                                            class="bi bi-plus-lg"></i> </button>
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

    @if ($errors->any())
        @section('script')
            <script>
                $(document).ready(function() {
                    $('#Basic_details').modal('show');
                });
            </script>
        @endsection
    @endif
            @push('scripts')
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
                            'Password must be at least 4 characters long and include at least  one lowercase letter ,one digit'
                        );
                    }

                    function addNewRow() {
                        ++i;
                        const newRow = $(`<tr>
                                <td><input type="text" id="subOfficeName_${i}" name="officedetails[${i}][Sub_Office_Name]" placeholder="Sub Company Name" class="form-control Sub_Office_Name-input" required /><span class="error-message"></span></td>
                                <td><input type="text" id="location_${i}" name="officedetails[${i}][Location]" placeholder="Location" class="form-control" required /></td>
                                <td><input type="email" id="emailOffice_${i}" name="officedetails[${i}][email_office]" placeholder="Email" class="form-control email-input" required /><span class="error-message"></span></td>
                                <td><input type="password" id="passwordOffice_${i}" name="officedetails[${i}][password_office]" placeholder="Password" class="form-control" required /><span class="error-message"></span></td>
                                <td><button type="button" class="btn btn-danger remove-input-field" data-index="${i}"><i class="bi bi-x-lg"></i></button></td>
                            </tr>`);

                        newRow.find('input[type="email"]').on('input', function() {
                            handleEmailInput($(this));
                        });

                        newRow.find('input[type="password"]').on('input', function() {
                            handlePasswordInput($(this));
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


            @endpush

@endsection
