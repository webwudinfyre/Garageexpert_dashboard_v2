<div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="view">View User</h1>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
        </div>
        <div class="modal-body">
            {{-- <form action="{{ $modalRoute }}" method="POST"> --}}
            <form action="{{ route('admin.registration.admincreate') }}" class="row g-3" method="POST">
                @csrf


                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingfirstName" placeholder="First Name"
                            name="First_Name" required autocomplete="First_Name" autofocus value={{ $posts->firstname }}
                            disabled>
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
                            name="Last_Name" required autocomplete="Last_Name" autofocus disabled
                            value={{ $posts->firstname }}>
                        <label for="floatingLastName"> Last Name</label>
                        @error('Last_Name')
                            <div class="alert-color" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingEmail" name="Email" placeholder="Email"
                            required autocomplete="Email" autofocus disabled value={{ $posts->users->email }}>
                        <label for="floatingEmail"> Email</label>
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
                            placeholder="Password" disabled>
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
                            <input type="text" class="form-control" id="floatingPhone" name="Phone_number"
                                placeholder="Phone Number" required disabled autocomplete="Phone_number" autofocus
                                value={{ $posts->phonenumber }}>
                            <label for="floatingPhone"> Phone Number</label>
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

                            <option value="1" selected>{{ $posts->users->status == '1' ? 'Active' : 'Inactive' }}
                            </option>

                        </select>
                        <label for="floatingStatus">Status</label>
                    </div>
                </div>

                <div class="text-center">

                    <button type="button" class="btn bg-primary_expert btn-style"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>

    </div>
</div>
