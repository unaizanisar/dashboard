@extends('layouts.app')
@section('title', 'Permission Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container mt-5">
            <h2 class="text-center">Permission Details</h2>
            <div class="mt-3">
                <p><strong>Name:</strong> {{ $permission->name }}</p>
                <p><strong>Module:</strong> {{ $permission->module }}</p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back to Permissions</a>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
