@extends('layouts.app')
@section('title', 'Category Details')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container mt-5">
            <h2 class="text-center">Category Details</h2>
            <div class="mt-3">

                <p><strong>Name:</strong> {{ $category->name }}</p>
                <p><strong>Description:</strong> {{ $category->description }}</p>

            </div>
            <div class="text-center mt-3">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories</a>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
