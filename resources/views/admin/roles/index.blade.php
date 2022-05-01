@extends('layouts.master')

@section('title')
    Roles | CSBNow
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Roles</h1>
                    <p class="mb-4">You can create or add roles in this page.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>  New Role</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($roles as $role)  
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success ml-1 mr-1"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                        @csrf 
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger deletebtn ml-1 mr-1"><i class="fas fa-fw fa-ban"></i>  Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')

@endsection