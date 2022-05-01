@extends('layouts.master')

@section('title')
    User Profile | CSBNow
@endsection

@section('content')

    <!-- Page Heading -->
    
    <h1 class="h3 mb-2 text-gray-800">User Profile</h1>
    <p class="mb-4">This is {{ Auth::user()->name }}'s Profile Page. </p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <!-- Profile -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4 border-left-success">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="mb-3 text-center rounded" style="background-image:url('../assets/img/school.jpg'); background-size: cover;">
                                        <img class="m-3 img-profile rounded-circle" style="width:200px" src="../uploads/profile_imgs/{{ Auth::user()->profile_img }}">
                                    </div>
                                    <h3 class="text-center">{{ Auth::user()->name }}</h3>
                                    <h5 class="text-muted text-center">{{ Auth::user()->usertype }}</h5>
                                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                                    <p class="text-muted text-center">{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Settings -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                                    <div class="dropdown no-arrow">
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="{{ route('user.postProfile') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <div class="mb-3">
                                            <label class="form-label">Profile Image</label><br>
                                            <input type="file" name="profile_img" class="form-control-file">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>

                                        <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>    Update Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://code.responsivevoice.org/responsivevoice.js"></script>

    <script>
        function textSpeak()
        {
            var text = document.getElementById("txt").value;
            responsiveVoice.speak(text);
        }
    </script>
@endsection