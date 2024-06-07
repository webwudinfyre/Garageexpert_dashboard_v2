<div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="view">View Client</h1>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
        </div>
        <div class="modal-body">
            {{-- <form action="{{ $modalRoute }}" method="POST"> --}}

                <form action="{{ route('admin.registration.clientcreate') }}" class="row g-3" method="POST">
                    @csrf


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input disabled type="text" class="form-control" id="floatingfirstName"
                                placeholder="First Name" name="First_Name" required autocomplete="First_Name" disabled
                                autofocus value="{{ $posts['client']->firstname }}">
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
                            <input disabled type="text" class="form-control" id="floatingLastName" placeholder="Last Name"
                                name="Last_Name" autocomplete="Last_Name" required autofocus
                                value={{ $posts['client']->lastname }}>
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
                            <input disabled type="email" class="form-control" id="floatingEmail" name="Email"
                                placeholder="Email" required autocomplete="Email" autofocus
                                value={{ $posts['client']->users->email }}>
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
                            <input disabled type="password" class="form-control" id="floatingPassword" name="Password"
                                placeholder="Password" required>
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
                                <input disabled type="text" class="form-control" id="floatingofficename"
                                    name="Office_Name" placeholder="Company Name" required
                                    autocomplete="Office_Name" autofocus value={{ $posts['client']->office }}>
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
                                <input disabled type="text" class="form-control" id="floatingLocation"
                                    name="Main_Location" placeholder="Location" required
                                    autocomplete="Main_Location" autofocus value={{ $posts['client']->location }}>
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
                                <input disabled type="text" class="form-control" id="floatingPhone"
                                    name="Phone_number" placeholder="Phone Number" required
                                    autocomplete="Phone_number" autofocus value={{ $posts['client']->phonenumber }}>
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
                            <select class="form-select" id="floatingStatus" aria-label="Status" disabled>

                                <option value="1" selected>{{ $posts['client']->users->status == '1' ? 'Active' : 'Inactive' }}
                                </option>

                            </select>
                            <label for="floatingStatus">Status</label>
                        </div>
                    </div>
                    @if ($posts['suboffice'] && count($posts['suboffice']) > 0 )

                    <div class="col-md-6 d-flex align-items-center">
                        <div class="add_office">
                            <h6 class="" id="Sub_Office_details">Sub Office details:</h6>


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

                            @foreach ($posts['suboffice'] as $suboffice )
                            <tr>
                                <td><input disabled type="text"
                                     placeholder="Sub Company Name"
                                     class="form-control Sub_Office_Name-input" required   value={{ $suboffice->office }}/>
                                </td>
                                <td><input disabled type="text"
                                    placeholder="Location"
                                    class="form-control location" required  value={{ $suboffice->location }} />
                               </td>
                               <td><input disabled type="text"
                                placeholder="Email"
                                class="form-control email" required  value={{ $suboffice->users->email }} />
                           </td>
                           <td><input disabled type="text"
                            placeholder="Password"
                            class="form-control email" required   />
                       </td>
                       <td><input disabled type="text"
                        placeholder="Password"
                        class="form-control email" required   />
                   </td>
                            </tr>

                             @endforeach




                        </table>
                    </div>
                    @endif

                    <div class="text-center">

                        <button type="button" class="btn bg-primary_expert btn-style"
                        data-bs-dismiss="modal">Close</button>


                    </div>
                </form>

        </div>

    </div>
</div>
