@extends('layouts.app')
@section('title', 'Inactive User')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body.bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%) !important;
        }
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
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Inactive') }}</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <p>Your account is inactive. Please contact support for further assistance.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
