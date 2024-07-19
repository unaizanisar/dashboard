@extends('layouts.app')

@section('title', 'Register')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>

    <!-- Local CSS Files -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- External CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body.bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%) !important;
        }
        /* .bg-login-image {
            background: url('{{ asset('vendor/img/login-bg.jpg') }}') no-repeat center center;
            background-size: cover;
        } */
        .card {
            border: 0;
            border-radius: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="firstname" type="text" placeholder="First Name" class="form-control form-control-user @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                        @error('firstname')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="lastname" type="text" placeholder="Last Name" class="form-control form-control-user @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                        @error('lastname')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="Email Address" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" placeholder="Password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <input id="address" type="text" placeholder="Address" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="gender" type="text" placeholder="Gender" class="form-control form-control-user @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="phone" type="text" placeholder="Phone" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register
                                    </button>
                                    <div class="text-center">
                                        @if (Route::has('login'))
                                            <p>Already have an account? <a class="small" href="{{ route('login') }}">Login</a></p>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
