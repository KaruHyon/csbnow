@extends('layouts.master')

@section('title')
    New Role | CSBNow
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Role</h1>
                    <p class="mb-4">You are creating a new role.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Role</h6>
                            <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action=" {{ route('roles.update', $role->id) }} " method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="role-name" class="col-form-label">Role name:</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}">
                                            @error('name') 
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form action=" {{ route('roles.permissions', $role->id) }} " method="POST" class="mb-3">
                                        @csrf
                                        @method('POST')

                                        <div class="mb-3">
                                            <label for="permission" class="col-form-label">Assign permissions:</label>
                                            <select id="permission" name="permission" class="form-control">
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Assign</button>
                                    </form>
                                    <div class="mb-3">
                                            <label for="permission" class="col-form-label">Role permissions:</label>
                                            <div class="d-flex">
                                                @if ( $role->permissions )
                                                    @foreach ($role->permissions as $permission)
                                                        <form method="POST" action="{{ route('roles.permissions.revoke', [$role->id, $permission->id]) }}" onsubmit="return confirm('Are you sure you want to revoke this permission from this role?');">
                                                            @csrf 
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-primary deletebtn ml-1 mr-1"><i class="fas fa-fw fa-cog"></i>  {{ $permission->name }}</button>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')

@endsection