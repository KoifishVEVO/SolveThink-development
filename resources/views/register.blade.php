<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #272780;
            height: 100vh;
        }

        .left-panel {

            height: 100%;

        }

        .login-container {
            max-width: 170vh;
            height: 80vh;
        }

        .form-control {
            padding: 0.75rem 1.5rem;
        }

        .btn-custom-primary:hover {
            background-color: #272780 !important;
            border-color: #272780 !important;
        }

        .btn-custom-primary {
            background-color: #272780 !important;
            border-color: #272780 !important;
            color: #fff !important;
            font-size: 20px;
        }

        ::placeholder {
            color: #89A1D0 !important;
            font-size: 14px;
        }

        .form-header-container {
            margin-bottom: 4rem;
            margin-top: -3rem;
        }

        .bottomtext a {
            color: #272780;
            text-decoration: none;
        }

        .bottomtext {
            color: #272780;
            text-decoration: none;
        }

        .left-shadow {
            box-shadow: -5px 0 5px rgba(0, 0, 0, 0.2);
        }

        .alert-text {
            font-size: 14px;
            color: red;
            padding: 1px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container login-container">
        <div class="row h-100 bg-white shadow">
            <!-- Left Panel with Logo -->
            <div class="col-md-5 d-flex align-items-center justify-content-center bg-white left-panel">
                <div class="text-center">
                    <img src="{{ asset('assets/images/solvethink_transparent.png') }}" alt="SolveThink Logo"
                        class="mb-2 img-fluid max-width: 100%">

                </div>
            </div>

            <!-- Right Panel with Form -->
            <div class="col-md-7 p-5 d-flex flex-column justify-content-center left-shadow">
                <div class="form-header-container text-center">
                    <h1 class="fw-bold display-4">Buat Akun Baru</h1>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill" placeholder="Nama Lengkap"
                            id="nama" name="nama" required autocomplete="off">
                    </div>
                    @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <input type="number" class="form-control rounded-pill" placeholder="No HP" id="hp"
                            name="no_hp" required autocomplete="off">
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="row mb-3">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <input type="password" class="form-control rounded-pill" placeholder="Password"
                                id="password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control rounded-pill" placeholder="Ketik Ulang Password"
                                id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-text text-center p2 small" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-custom-primary rounded-pill py-2 fw-bold">Buat
                            Akun</button>
                    </div>
                </form>
                <div class="text-center mt-3 bottomtext">
                    <span> Sudah Punya Akun? <a href="{{ url('/') }}" class="fw-bold">Login!</a></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
