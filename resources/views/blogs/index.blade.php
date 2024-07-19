@extends('layouts.app')
@section('title', 'Blogs')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Blogs</h1>
                    <div class="col text-right">
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add New Blog</a>
                    </div>
                    <br>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="blogs_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Category</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $index => $blog)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->content }}</td>
                                                <td>{{optional($blog->category)->name}}</td>
                                                <td>{{optional($blog->user)->fullname}}</td>
                                                <td>
                                                    @if ($blog->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info" title="Details"><i class='fa fa-eye'></i></a> |
                                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class='fa fa-pen'></i></a> |
                                                    <form action="{{ route('blogs.delete', $blog->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this blog?');">
                                                            <i class='fa fa-trash'></i>
                                                        </button>
                                                    </form> |
                                                    @if ($blog->status == 1)
                                                        <a href="{{ route('blogs.status', ['id' => $blog->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="Deactivate" onclick="return confirm('Are you sure you want to deactivate this blog?');"><i class='fas fa-user-slash'></i></a>
                                                    @else
                                                        <a href="{{ route('blogs.status', ['id' => $blog->id, 'status' => 1]) }}" class="btn btn-sm btn-success" title="Activate" onclick="return confirm('Are you sure you want to activate this blog?');"><i class='fa fa-user-check'></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr style="text-align: center">
                                                <td colspan="5">Record Not Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success("{{ session('success') }}");
            });
        </script>
    @endif
@endsection
