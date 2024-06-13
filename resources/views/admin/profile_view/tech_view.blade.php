@extends('admin.layouts.master')

@section('contents')

<div id="pagetitle" class="pagetitle">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-8  align-items-center ">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Technicians Profile</li>
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


                    <h5 class="my-3">@nullOrValue($Adminusers->users->name, 'Name')</h5>
                    <p class="text-muted mb-1">@nullOrValue($Adminusers->Position, 'Position')</p>
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
                            <i class="bi bi-linkedin bi-lg text-warning"><span class="icon-name">Linkedin</span></i>
                            <p class="mb-0">@nullOrValue($Adminusers->linkedin, 'linkedin ')</p>
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
                            <p class="mb-0">Position</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">@nullOrValue($Adminusers->Position, 'Position')</p>
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
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">@nullOrValue($Adminusers->Address, 'Address')</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="card mb-4 mb-md-0">

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
                            action="{{ route('admin.registration.tech.profilecreatesocial', ['id' => encrypt($Adminusers->id)]) }}"
                            class="row g-3" method="post">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatinglinkedin"
                                        placeholder="linkedin " name="linkedin" required autocomplete="linkedin"
                                        autofocus value="@nullOrValuenostyle($Adminusers->linkedin, 'linkedin ')">
                                    <label for="floatinglinkedin">linkedin </label>
                                    @error('linkedin')
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
                            action="{{ route('admin.registration.tech.profilebasic_details', ['id' => encrypt($Adminusers->id)]) }}"
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

@if ($errors->any())
    @section('script')
        <script>
            $(document).ready(function() {
                $('#Basic_details').modal('show');
            });
        </script>
    @endsection
@endif
@endsection
