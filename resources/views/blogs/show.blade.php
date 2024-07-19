@extends('layouts.app')
@section('title', 'Blog Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container mt-5">
            <h2 class="text-center">Blog Details</h2>
            <div class="mt-3">

                <p><strong>Title:</strong> {{ $blog->title }}</p>
                <p><strong>Content:</strong> {{ $blog->content }}</p>
                <p><strong>Catgory:</strong> {{ $blog->category->name }}</p>
                <p><strong>User:</strong> {{ $blog->user->fullname }}</p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('blogs.index') }}" class="btn btn-primary">Back to Blogs</a>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
