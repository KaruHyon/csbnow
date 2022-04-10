@extends('layouts.master')

@section('title')
    Edit Role | CSBNow
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Role</h1>
                    <p class="mb-4">You are editing {{ $users->name }}'s role.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $users->name }}'s Role</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <form action="/role-update/{{ $users->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="username" value="{{ $users->name }}">
                                    </div>
                                    <div class="mb-3">
                                    <label class="form-label">Role</label>
                                        <select class="form-control" name="usertype">
                                            <option value="admin">Administrator</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="/faculty" class="btn btn-danger">Cancel</a>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')

@endsection