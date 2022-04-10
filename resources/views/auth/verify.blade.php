@extends('layouts.frontend')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CSBNow - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success" style="background-image:url('../assets/img/school.jpg'); background-size: cover;">

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->

                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <div class="row">
                                

                                    <div class="p-5">
                                        <div class="text-center">
                                            <img src="../assets/img/csbnowlogo-colored.png" class="img-fluid pb-4" style="width:60%">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <p> 
                                                Your account has not been verified and / or not given access to the dashboard yet.
                                                <br>
                                                Please check your email for a verification or contact an Administrator to provide you access to the dashboard.
                                            </p>
                                        </div>
                                        
                                        <hr>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
@endsection