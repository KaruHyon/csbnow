@extends('layouts.master')

@section('title')
    Sections | CSBNow
@endsection

@section('content')

<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/save-sections" method="POST">
      {{ csrf_field() }}

        <div class="modal-body">
            <div class="mb-3">
              <label for="course-title" class="col-form-label">Section Name:</label>
              <input type="text" name="section-name" class="form-control" id="course-title">
            </div>
            <div class="mb-3">
              <label for="course-id" class="col-form-label">Section ID:</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add Section</button>
        </div>
      
      </form>
    </div>
  </div>
</div>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sections</h1>
                    <p class="mb-4">You can manage sections in this page.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
                            @can('add')
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle"></i>  New Section</button>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Section ID</th>
                                            <th>Section Name</th>
                                            <!--<th class="col-md-6">Subjects</th>-->
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $sections as $section )
                                            <tr>
                                                <td>{{ $section->id }}</td>
                                                <td>{{ $section->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-success ml-1 mr-1"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                        <form method="POST" action="{{ route('sections.delete', $section->id) }}" onsubmit="return confirm('Are you sure you want to delete this section?');">
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