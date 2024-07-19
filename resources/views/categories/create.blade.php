@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Category</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form id="registerForm" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
@endsection
