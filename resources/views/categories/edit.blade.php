@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $category->description) }}">
                    @error('description')
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
