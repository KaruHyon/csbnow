@extends('layouts.master')

@section('title')
    User Profile | CSBNow
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Settings</h6>
    </div>
        <div class="card-body">
            <div>
                <div>
                    <form class="form-horizontal" method="POST" action="{{ route('userPostSettings') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="newpassword">Enter New Password</label>
                                    <input type="password" name="newpassword"  id="newpassword" class="form-control @error('newpassword') is-invalid @enderror" value="" required placeholder="New Password">
                                    @error('newpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="newpassword_confirmation">Confirm New Password</label>
                                    <input type="password" name="newpassword_confirmation"  id="newpassword_confirmation" class="form-control @error('newpassword_confirmation') is-invalid @enderror" value="" required placeholder="Confirm Password">
                                    @error('newpassword_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-lock"></i> Change Password</button>
                                    {{--  <a role="button" href="admin/index.html" class="bizwheel-btn theme-2">Login</a>  --}}
                                </div>
                            </div>
                        </div>
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