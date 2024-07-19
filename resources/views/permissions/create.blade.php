@extends('layouts.app')

@section('title', 'Add Permission')

@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Permission</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form id="registerForm" method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="module">Module</label>
                        <input type="text" class="form-control" id="module" name="module" value="{{ old('module') }}">
                        @if ($errors->has('module'))
                            <span class="text-danger">{{ $errors->first('module') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Add Permission</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
