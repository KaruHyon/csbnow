@extends('layouts.master')

@section('title')
    Dashboard | CSBNow
@endsection

@section('content')

    <!-- Page Heading -->
    
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

                    <div class="card bg-dark text-white shadow mb-4">
                        <div class="card-body">
                            Welcome back, {{ Auth::user()->name }}!
                            <div class="text-white-50 small">
                                You are currently logged in as a {{ Auth::user()->roles->pluck('name')[0] ?? ''  }}!
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Faculty</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{{ $totals['teacher'] }}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{{ $totals['student'] }}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Subjects</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{{ $totals['course'] }}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Modules</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-paperclip fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Text-to-speech Converter</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="text-input" class="col-form-label">Text input:</label>
                                        <textarea id="txt" name="text-input" class="form-control" rows="5"></textarea>
                                    </div>
                                    <button type="submit" onclick="textSpeak()" class="btn btn-success">Play</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-4 mb-4" style="width: 25rem;" src="../assets/img/undraw_analysis_re_w2vd.svg" alt="...">
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