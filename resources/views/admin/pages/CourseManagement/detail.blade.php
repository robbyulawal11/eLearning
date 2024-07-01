@extends('admin.layouts.app')
@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h5 class="fs-8 mb-3 fw-bold">{{ $data->name }}</h5>
            <p class="bg-success px-2 py-1 text-white text-center align-middle rounded-1"
                style="max-width: 50px; height: 30px">
                {{ $data->category->namaKategori }}
            </p>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-start">
            <video width="500" height="auto" controls class="mb-3">
                <source src="{{ asset('storage/videos/courses/' . $data->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="ms-md-5">
                <h6 class="fs-5 fw-semibold">About this course</h6>
                <p>{{ $data->description }}</p>
            </div>
        </div>
        <div class="mb-3">
            <h6 class="fs-5 fw-semibold">Transcript This Course</h6>

            <button class="btn btn-primary p-2" id="send-video-button" data-video-id="{{ $data->id }}">Generate
                Transcript</button>
            <div id="loading" style="display: none;">Loading, please wait...</div>
            <div id="response-container"></div>

        </div>
        <div>
            <h6 class="fs-5 fw-semibold">Summary This Course</h6>
            <p></p>
            <button class="btn btn-primary p-2">Generate Summary</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('send-video-button').addEventListener('click', function() {
                var videoId = this.getAttribute('data-video-id');

                // Tampilkan loading indicator
                document.getElementById('loading').style.display = 'block';
                document.getElementById('response-container').innerHTML = '';

                axios.get('/send-video/' + videoId)
                    .then(function(response) {
                        // Sembunyikan loading indicator
                        document.getElementById('loading').style.display = 'none';
                        // Tampilkan respons
                        document.getElementById('response-container').innerHTML = JSON.stringify(
                            response.data);
                    })
                    .catch(function(error) {
                        // Sembunyikan loading indicator
                        document.getElementById('loading').style.display = 'none';
                        // Tampilkan pesan error
                        document.getElementById('response-container').innerHTML =
                        'Failed to send video';
                    });
            });
        });
    </script>
@endsection
