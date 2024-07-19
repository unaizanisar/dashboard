@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container mt-5">
    <h2 class="text-center">Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}">
            @error('firstname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
            @error('lastname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="profile_photo">Profile Photo</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            @if ($user->profile_photo)
                <div class="mt-2">
                    <img src="{{ asset('uploads/' . $user->profile_photo) }}" alt="Profile Photo" class="img-fluid">
                </div>
            @endif
            @error('profile_photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    @include('layouts.footer')
</div>

</div>
</div>
@endsection
