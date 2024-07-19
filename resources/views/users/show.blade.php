@extends('layouts.app')
@section('title', 'User Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container mt-5">
            <h2 class="text-center">User Details</h2>
            <div class="mt-3">
            @if ($user->profile_photo)
                <img src="{{ asset('uploads/' . $user->profile_photo) }}" class="rounded-circle" alt="{{ $user->fullname }}" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <img src="{{ asset('default-avatar.png') }}" class="rounded-circle" alt="Default Avatar" style="width: 150px; height: 150px; object-fit: cover;">
            @endif
                <p><strong>First Name:</strong> {{ $user->firstname }}</p>
                <p><strong>Last Name:</strong> {{ $user->lastname }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Address:</strong> {{ $user->address }}</p>
                <p><strong>Gender:</strong> {{ $user->gender }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users</a>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
