@extends('layouts.app')
@section('title', 'Role Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container mt-5">
            <h2 class="text-center">Role Details</h2>
            <div class="mt-3">
                <p><strong>Name:</strong> {{ $role->name }}</p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
