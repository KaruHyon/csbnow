@extends('layouts.master')

@section('title')
    Edit Course | CSBNow
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Subject</h1>
                    <p class="mb-4">You are editing {{ $courses->title }}'s information.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $courses->title }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action=" {{ url('courses-update/'.$courses->id) }} " method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                        <div class="mb-3">
                                            <label for="course-title" class="col-form-label">Subject Title:</label>
                                            <input type="text" name="course-title" class="form-control" value=" {{ $courses->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="course-id" class="col-form-label">Subject ID:</label>
                                            <input type="text" name="name" class="form-control" value=" {{ $courses->id }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="course-description" class="col-form-label">Description:</label>
                                            <textarea name="course-description" class="form-control" rows="6">{{ $courses->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="{{ url('courses') }}" class="btn btn-danger">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')

@endsection