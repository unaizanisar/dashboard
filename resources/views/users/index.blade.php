@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <div class="col text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
                    </div>
                    <br>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="users_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->firstname }}</td>
                                                <td>{{ $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ optional($user->role)->name ?? 'No Role' }}</td>
                                                <td>
                                                    @if ($user->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info" title="Details"><i class='fa fa-eye'></i></a> |
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class='fa fa-pen'></i></a> |
                                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                                            <i class='fa fa-trash'></i>
                                                        </button>
                                                    </form> |
                                                     @if ($user->status == 1)
                                                        <a href="{{ route('users.status', ['id' => $user->id, 'status' => 0]) }}" class="btn btn-sm btn-danger" title="Deactivate" onclick="return confirm('Are you sure you want to deactivate this user?');"><i class='fas fa-user-slash'></i></a>
                                                    @else
                                                        <a href="{{ route('users.status', ['id' => $user->id, 'status' => 1]) }}" class="btn btn-sm btn-success" title="Activate" onclick="return confirm('Are you sure you want to activate this user?');"><i class='fa fa-user-check'></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr style="text-align: center">
                                                <td colspan="9">Record Not Found</td>
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
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success("{{ session('success') }}");
            });
        </script>
    @endif
@endsection
