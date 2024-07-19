@extends('layouts.app')
@section('title', 'Edit Permission')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Edit Permission</h1>
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $permission->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Module</label>
                    <input type="text" class="form-control" id="module" name="module" value="{{ old('module', $permission->module) }}">
                    @error('module')
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
