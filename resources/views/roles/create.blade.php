@extends('layouts.app')

@section('title', 'Add Role')

@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Role</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form id="registerForm" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Permissions</label><br>
                        @foreach ($permissionsByModule as $module => $permissions)
                            <h5>{{ htmlspecialchars($module) }}</h5>
                            @foreach ($permissions as $permission)
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                    <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ htmlspecialchars($permission->name) }}</label>
                                </div>
                            @endforeach
                            <hr>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
