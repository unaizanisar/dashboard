@extends('layouts.app')

@section('title', 'Add Blog')

@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container">
    <h1>Add New Blog</h1>
    <form method="POST" action="{{ route('blogs.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="user_id">User</label>
            <select id="user_id" name="user_id" class="form-control" required>
                <option value="">Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->firstname }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Blog</button>
    </form>
    @include('layouts.footer')
</div>
</div>
</div>
@endsection
