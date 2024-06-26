@extends('layouts.master')

@section('title')
  {{ ucfirst(trans($text)) }} | CSBNow
@endsection

@section('content')

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.add') }}" method="POST">
      @csrf

        <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="email" class="col-form-label">Email:</label>
              <input type="text" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
                <select id="role" name="role" class="form-control" hidden>
                    <option value="{{ $roleset }}">{{ $roleset }}</option>
                </select>
                <select id="course" name="course" class="form-control" hidden>
                    <option value="{{ $rolecourse }}">{{ $rolecourse }}</option>
                </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add User</button>
        </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Archive Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Archive</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($archived as $archive)  
                                            <tr>
                                                <td>{{ $archive->name }}</td>
                                                <td>{{ $archive->email }}</td>
                                                <td>
                                                    @if( !empty($archive->roles->first()->name))
                                                        {{ $archive->roles->first()->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('users.archive.restore', $archive->id) }}" class="btn btn-success ml-1 mr-1" onclick="return confirm('Are you sure you want to restore this user?');"><i class="fas fa-fw fa-undo"></i></a>
                                                        <form method="POST" action="{{ route('users.archive.destroy', $archive->id) }}" onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                                                        @csrf 
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger deletebtn ml-1 mr-1"><i class="fas fa-fw fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ ucfirst(trans($text)) }}</h1>
                    <p class="mb-4">You can manage users in this page.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="row mr-1 ml-1">
                                <h6 class="m-0 font-weight-bold text-primary float-left ">{{ ucfirst(trans($text)) }}</h6>
                            </div>
                            <div class="row mr-1 ml-1">
                            @can('add')
                                <button type="button" class="btn btn-primary float-right mr-1 ml-1" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i>  Add User</a>
                            @endcan
                            @can('delete')
                                <button type="button" class="btn btn-warning float-right mr-1 ml-1" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i>  Archive</button>
                            @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            @can('manage')
                                                <th class="col-md-2">Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if( !empty($user->roles->first()->name))
                                                        {{ $user->roles->first()->name }}
                                                    @endif
                                                </td>
                                                @can('manage')
                                                <td>
                                                    <div class="d-flex">
                                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-success ml-1 mr-1"><i class="fas fa-fw fa-edit"></i> Edit</a>

                                                        @can('delete')
                                                        <form method="POST" action="{{ route('users.delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf 
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger deletebtn ml-1 mr-1"><i class="fas fa-fw fa-ban"></i>  Delete</button>

                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                                @endcan
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