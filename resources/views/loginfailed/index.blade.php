<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Garagexpert</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <style>
        .bg-primary_expert {
            background-color: #FF530A;
            color: white;
        }

        .bg-primary_expert:hover {
            background-color: #ed3e33;
            color: white;
            border: 1px solid #ced4da;
        }

        .invalid-feedback {
            color: red;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .invalid-feedback2 {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }
        span.position-absolute {
    margin-right: 5px;
}
.password_class {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
    </style>
</head>

<body>

    <section class="vh-100" style="background-color: #f7f5f4;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('admin/assets/img/Login_banner.webp') }}"
                                alt="login form" class="img-fluid"
                                style="border-radius: 1rem 0 0 1rem; height:100%" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="d-flex mb-3 pb-1">
                                            <div class="logo d-flex">
                                                {{-- <img src="{{ asset('admin/assets/img/Garage-Logo.png') }}"
                                                    alt=""> --}}
                                                    <img src="{{ asset('admin/assets/img/Garagexpert_logo@4x.png') }}" style="height:65px"
                                                    alt="">
                                            </div>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h5>
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif

                                        <div class="mb-4">
                                            <label for="email" class="form-label">{{ __('Email address') }}</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus autocomplete="username"
                                                class="form-control form-control-lg" />
                                        </div>


                                        <div class="mb-4">

                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <div class="password_class">
                                            <input type="password" id="password" name="password" required
                                                autocomplete="current-password" class="form-control form-control-lg" />

                                                <span class="position-absolute  ">
                                                    <i class="bi bi-eye-slash" id="togglePasswordnew" style="cursor: pointer; color:#FF530A;"></i>
                                                </span>
                                            @if ($errors->has('password'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                            </div>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn bg-primary_expert btn-lg btn-block" type="submit"
                                                style="width:150px;">Login</button>
                                        </div>
                                        {{-- @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="small text-muted">Forgot
                                                password?</a>
                                        @endif --}}

                                        <p></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {
        $('#togglePasswordnew').on('click', function() {
            const passwordField = $('#password');
            const passwordFieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', passwordFieldType);
            $(this).toggleClass('bi-eye bi-eye-slash');
        });
    });
    </script>
</body>

</html>
