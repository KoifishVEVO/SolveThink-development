@extends('layouts.header')

@section('title') 
    Register
@endsection

@section('content')
    <div class="container login-container">
        <div class="row h-100  bg-white shadow rounded-3">
            <!-- Left Panel(logo) -->
            <div class="col-md-5 d-flex align-items-center justify-content-center bg-white left-panel d-none d-lg-flex rounded-3">

                <div class="text-center">
                    <img src="{{asset('assets/images/solvethink_transparent.png')}}" alt="SolveThink Logo" class="mb-2 img-fluid max-width: 100%">

                </div>
            </div>

            <!-- Right Panel(form)-->
            <div class="col-md-12 col-lg-7 col-sm-12 p-8 d-flex flex-column justify-content-center left-shadow">
                <div class="form-header-container text-center mt-1 ">
                    <h1 class="fw-bold h-2 ">Buat Akun Baru</h1>
                </div>
                <form method="POST" action = "{{ url('/register') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill" placeholder="Nama Lengkap" id="nama">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill" placeholder="No HP" id="hp">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <input type="password" class="form-control rounded-pill" placeholder="Password" id="password">
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control rounded-pill" placeholder="Ketik Ulang Password" id="confirmPassword">
                        </div>
                    </div>

                    @if (session('error'))
                    <div class="alert alert-text text-center p2 small" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-custom-primary rounded-pill py-2 fw-bold">Buat Akun</button>
                    </div>
                </form>
                <div class="text-center mt-3 bottomtext">
                    <span> Sudah Punya Akun? <a href="{{ url('/') }}" class="fw-bold">Login!</a></span>
                </div>
            </div>
        </div>
    </div>
    @endsection
