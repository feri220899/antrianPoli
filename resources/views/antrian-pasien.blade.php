@extends('layout.layoutpendaftaran')
@section('title', 'Home')

@section('konten')
    <div class="d-flex justify-content-between align-items-center container-fluid mt-3 bg-light py-2 px-3">
        <img src="/img/rs.png" width="140px" height="110px" alt="" srcset="">
        <div class="pricing-header ">
            <h1 class="display-4 font-weight-bold text-success">ANTRIAN POLI</h1>
        </div>
        <img src="/img/bpjs.png" width="280px" height="50px" alt="" srcset="">
    </div>
    <hr style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); height: 2px; border: none;">
    <div class="row text-light" style="min-height: 70vh;">
        <div class="col-sm d-flex justify-content-center align-items-center">
            <div id="ViewAntrian">

            </div>
        </div>
        <div class="col-sm d-flex justify-content-center align-items-center">
            <video id="videoPlayer" width="100%" height="100%" autoplay>
                <source src="{{ url('video/Pendaftaran.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <hr style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); height: 2px; border: none;">

    </div>
    <script>
        var video = document.getElementById("videoPlayer");
        video.addEventListener("ended", function() {
            video.currentTime = 0;
            video.play();
        });


        // Untuk Get data realtime
        $(document).ready(function() {
            getData();
        });

        function getData() {
            var urlParams = new URLSearchParams(window.location.search);
            var kd_dokter = urlParams.get('kd_dokter');
            var requestData = {
                kd_dokter: kd_dokter,
            };
            $.get("{{ url('view-component-antrian') }}", requestData, function(data, status) {
                $("#ViewAntrian").html(data);
                setTimeout(getData, 1000);
            });
        }
    </script>
@endsection
