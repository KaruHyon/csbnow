@extends('layouts.master')

@section('title')
    Edit User Role | CSBNow
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit User Role</h1>
                    <p class="mb-4">You are editing {{ $user->name }}'s roles and permissions.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Roles & Permissions</h6>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action=" {{ route('users.roles', $user->id) }} " method="POST" class="mb-3">
                                        @csrf
                                        @method('POST')

                                        <div class="mb-3">
                                            <label for="role" class="col-form-label">Assign roles:</label>
                                            <select id="role" name="role" class="form-control">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Assign</button>
                                    </form>
                                    <div class="mb-3">
                                            <label for="permission" class="col-form-label">Roles:</label>
                                            <div class="d-flex">
                                                @if ( $user->roles )
                                                    @foreach ($user->roles as $user_role)
                                                        <form method="POST" action="{{ route('users.roles.remove', [$user->id, $user_role->id]) }}" onsubmit="return confirm('Are you sure you want to revoke this role from this user?');">
                                                            @csrf 
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-primary deletebtn ml-1 mr-1"><i class="fas fa-fw fa-cog"></i>  {{ $user_role->name }}</button>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                    <form action=" {{ route('users.permissions', $user->id) }} " method="POST" class="mb-3">
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
                                            <label for="permission" class="col-form-label">Permissions:</label>
                                            <div class="d-flex">
                                                @if ( $user->permissions )
                                                    @foreach ($user->permissions as $user_permissions)
                                                        <form method="POST" action="{{ route('users.permissions.revoke', [$user->id, $user_permissions->id]) }}" onsubmit="return confirm('Are you sure you want to revoke this permission from this user?');">
                                                            @csrf 
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-primary deletebtn ml-1 mr-1"><i class="fas fa-fw fa-cog"></i>  {{ $user_permissions->name }}</button>
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