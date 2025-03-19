@extends('layouts.header')

@section('title') 
    Login
@endsection

@section('content')
    <div class="container login-container" >
        <div class="row h-100 bg-white shadow rounded-3">
            <!-- Left Panel(logo) -->
            <div class="col-md-5 d-flex align-items-center justify-content-center bg-white left-panel d-none d-lg-flex rounded-3">
                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                    <img src="{{ asset('assets/images/solvethink_transparent.png') }}" alt="SolveThink Logo"
                        class="img-fluid" style="max-width: 100%;">
                </div>
            </div>

            <!-- Right Panel(form)-->
            <div class="col-md-12 col-lg-7 col-sm-12 p-8 d-flex flex-column justify-content-center left-shadow">
                <div class="form-header-container text-center">
                    <h1 class="fw-bold display-4">Login</h1>
                </div>
                <form method="POST" action = "{{ url('/dashboard') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill" placeholder="Nomor HP" id="hp">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control rounded-pill" placeholder="Password" id="password">
                    </div>

                   
                    @if (session('error'))
                        <div class="alert alert-text text-center p2 small" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-grid gap-2  pt-md-4" style="padding-top: 6rem;">
                        <button type="submit" class="btn btn-custom-primary rounded-pill py-2 fw-bold">MASUK</button>
                    </div>
                </form>
                <div class="text-center mt-3 bottomtext fs-sm fs-md">
                    <span>Belum punya akun? <a href="{{ url('/register') }}" class="fw-bold">Register!</a></span>
                </div>
            </div>
        </div>
    </div>

    @endsection
