<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Laravel | Boilerplate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="laravel boilerplate with Skote Template" name="description" />
    <meta content="alief" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('app.theme') }}assets/images/favicon.ico">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ config('app.theme') }}assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="{{ config('app.theme') }}assets/libs/owl.carousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap Css -->
    <link href="{{ config('app.theme') }}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ config('app.theme') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ config('app.theme') }}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">

    <div>
        <div class="container-fluid p-0">
            <div class="row no-gutters">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{ config('app.theme') }}assets/images/logo-dark.png" alt=""
                                            height="18" class="auth-logo-dark">
                                        <img src="{{ config('app.theme') }}assets/images/logo-light.png" alt=""
                                            height="18" class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Selamat Datang !</h5>
                                        <p class="text-muted">Masuk untuk melanjutkan.</p>
                                    </div>

                                    @if (Session::has('error-msg'))
                                    <div class="alert alert-danger" role="alert">
                                        @php
                                        Session::get('error-msg', 'default');
                                        @endphp
                                    </div>
                                    @endif

                                    @if (session('message'))
                                    <div class="alert alert-danger">{{ session('message') }}</div>
                                    @endif

                                    <div class="mt-4">
                                        <form action="{{route('login')}}" autocomplete="off" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label for="username">Nama Pengguna</label>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" value="{{old('username')}}"
                                                    placeholder="Masukkan Nama Pengguna" autofocus>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                {{-- <div class="float-right">
                                                    <a href="auth-recoverpw-2.html" class="text-muted">Forgot
                                                        password?</a>
                                                </div> --}}
                                                <label for="password">Kata Sandi</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" value="{{old('password')}}"
                                                        placeholder="Masukkan Kata Sandi">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary" id="show"><i
                                                                class="bx bx-show"></i></button>
                                                    </div>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Masuk</button>
                                            </div>

                                        </form>
                                        {{-- <div class="mt-5 text-center">
                                            <p>Don't have an account ? <a href="auth-register-2.html"
                                                    class="font-weight-medium text-primary"> Signup now </a> </p>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                        Themesbrand</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ config('app.theme') }}assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ config('app.theme') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('app.theme') }}assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ config('app.theme') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ config('app.theme') }}assets/libs/node-waves/waves.min.js"></script>

    <!-- owl.carousel js -->
    <script src="{{ config('app.theme') }}assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- auth-2-carousel init -->
    <script src="{{ config('app.theme') }}assets/js/pages/auth-2-carousel.init.js"></script>

    <!-- App js -->
    <script src="{{ config('app.theme') }}assets/js/app.js"></script>
    <script>
        let show = false;
        $('#show').on('click', function () {
            if (show == false) {
                $('#password').attr('type', 'text');
                show = true;
            } else {
                $('#password').attr('type', 'password');
                show = false;
            }
        })
    </script>

</body>

</html>