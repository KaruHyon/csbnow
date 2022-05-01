@extends('layouts.master')

@section('title')
    New Role | CSBNow
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">New Role</h1>
                    <p class="mb-4">You are creating a new role.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Role</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action=" {{ route('roles.store') }} " method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="role-name" class="col-form-label">Role name:</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" >
                                            @error('name') 
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success">Create</button>
                                        <a href="{{ url('roles') }}" class="btn btn-danger">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')

@endsection