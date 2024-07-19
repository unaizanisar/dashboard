@extends('layouts.app')
@section('title', 'Edit Blog')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Blog</h1>

    <form method="POST" action="{{ route('blogs.update', $blog->id) }}" id="editForm">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content">{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <select class="form-control" id="user_id" name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $blog->user_id ? 'selected' : '' }}>
                        {{ $user->firstname }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    @include('layouts.footer')
</div>
@endsection
