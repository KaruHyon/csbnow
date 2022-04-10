@extends('layouts.master')

@section('title')
    Faculty | CSBNow
@endsection

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Faculty</h1>
                    <p class="mb-4">You can change Faculty account details in this page. </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Faculty members</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->usertype }}</td>
                                            <td>
                                                <form action="/role-delete/{{ $row->id }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <a href="/role-edit/{{ $row->id }}" class="btn btn-success"><i class="fas fa-fw fa-edit"></i>   Edit</a>
                                                    <input type="hidden" name="id" value="">
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-ban"></i>   Delete</a>
                                                </form>
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