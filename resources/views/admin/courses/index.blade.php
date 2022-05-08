@extends('layouts.master')

@section('title')
    Subjects | CSBNow
@endsection

@section('content')

<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/save-course" method="POST">
      {{ csrf_field() }}

        <div class="modal-body">
            <div class="mb-3">
              <label for="course-title" class="col-form-label">Subject Title:</label>
              <input type="text" name="course-title" class="form-control" id="course-title">
            </div>
            <div class="mb-3">
              <label for="course-id" class="col-form-label">Subject ID:</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="course-description" class="col-form-label">Description:</label>
              <textarea name="course-description" class="form-control" id="course-description"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add Subject</button>
        </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="delete-modal-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-body">
          <input type="hidden" id="delete-course-id">
          Are you sure you want to delete this subject?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
  

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Subjects</h1>
                    <p class="mb-4">You can enroll new subjects in this page.</p>
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
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle"></i>  New Subject</button>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject ID</th>
                                            <th>Subject Title</th>
                                            <th class="col-md-5">Description</th>
                                            @can('manage')
                                              <th class="col-md-2">Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($courses as $data)  
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>
                                                  <div style="height: 80px; overflow: hidden;">
                                                  {{ $data->description }}
                                                  </div>
                                                </td>
                                                @can('manage')
                                                <td>
                                                  <a href="{{ url('courses/'.$data->id) }}" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                  @can('delete')
                                                  <a href="javascript:void(0)" class="btn btn-danger deletebtn"><i class="fas fa-fw fa-ban"></i>  Delete</a>
                                                  @endcan
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

<script>
    $('#dataTable').on('click', '.deletebtn', function()
      {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function()
        {
          return $(this).text();
        }).get();

        //console.log(data);

        $('#delete-course-id').val(data[0]);

        $('#delete-modal-form').attr('action', '/courses-delete/'+data[0]);

        $('#deletemodal').modal('show');
      });
  </script>

@endsection