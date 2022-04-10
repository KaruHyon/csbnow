@extends('layouts.master')

@section('title')
    Dashboard | CSBNow
@endsection

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Text-to-Speech</h1>
                    <p class="mb-4">You can convert text into speech in this page.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Text-to-speech Converter</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="text-input" class="col-form-label">Text input:</label>
                                        <textarea id="txt" name="text-input" class="form-control" rows="5"></textarea>
                                    </div>
                                    <button type="submit" onclick="textSpeak()" class="btn btn-success">Play</button>
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