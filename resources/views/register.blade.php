@extends('layouts.header')

@section('title')
    Register
@endsection

@section('content')
    <div class="container login-container">
        <div class="row h-100  bg-white shadow rounded-3">
            <!-- Left Panel(logo) -->
            <div
                class="col-md-5 d-flex align-items-center justify-content-center bg-white left-panel d-none d-lg-flex rounded-3">

                <div class="text-center">
                    <img src="{{ asset('assets/images/solvethink_transparent.png') }}" alt="SolveThink Logo"
                        class="mb-2 img-fluid max-width: 100%">

                </div>
            </div>

            <!-- Right Panel(form)-->
            <div class="col-md-12 col-lg-7 col-sm-12 p-8 d-flex flex-column justify-content-center left-shadow">
                <div class="form-header-container text-center mt-1 ">
                    <h1 class="fw-bold h-2 ">Buat Akun Baru</h1>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <input type="text" class="form-control rounded-pill @error('nama') is-invalid @enderror"
                            placeholder="Nama Lengkap" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div class="mb-3">
                        <input type="number" class="form-control rounded-pill @error('no_hp') is-invalid @enderror"
                            placeholder="No HP" id="hp" name="no_hp" value="{{ old('no_hp') }}" required>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password dan Konfirmasi Password -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <input type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"
                                placeholder="Password" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="password"
                                class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror"
                                placeholder="Ketik Ulang Password" id="password_confirmation" name="password_confirmation"
                                required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Notifikasi Error Global -->
                    @if (session('error'))
                        <div class="alert alert-danger text-center p-2 small" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Tombol Submit -->
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
