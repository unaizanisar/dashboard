@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')
<div id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Edit Role</h1>
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $role->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Permissions</label><br>
                    @foreach ($permissionsByModule as $module => $permissions)
                        <h5>{{ htmlspecialchars($module) }}</h5>
                        @foreach ($permissions as $permission)
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ htmlspecialchars($permission->name) }}</label>
                            </div>
                        @endforeach
                        <hr>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            @include('layouts.footer')
        </div>

    </div>
</div>
@endsection
