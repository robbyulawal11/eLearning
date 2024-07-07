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

            <button class="btn btn-primary p-2" id="generate-transcript-button" data-video-id="{{ $data->id }}">Generate
                Transcript</button>
            <hr>
            <div id="loading-transcript" style="display: none;">Generating transcript, please wait...</div>
            <div id="transcript-response-container"></div>

        </div>
        <div>
            <h6 class="fs-5 fw-semibold">Summary This Course</h6>

            <button class="btn btn-primary p-2" id="generate-summary-button" data-video-id="{{ $data->id }}">Generate
                Summary</button>
            <hr>
            <div id="loading-summary" style="display: none;">Generating summary, please wait...</div>
            <div id="summary-response-container"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generate-transcript-button').addEventListener('click', async function() {
                var videoId = this.getAttribute('data-video-id');

                // Tampilkan loading indicator
                document.getElementById('loading-transcript').style.display = 'block';
                document.getElementById('transcript-response-container').innerHTML = '';

                try {
                    var response = await axios.get('/generate-transcript/' + videoId, {
                        timeout: 300000,
                        responseType: 'text'
                    });
                    console.log(response.data);
                    document.getElementById('loading-transcript').style.display = 'none';
                    document.getElementById('transcript-response-container').innerHTML = response.data;
                } catch (error) {
                    document.getElementById('loading-transcript').style.display = 'none';
                    document.getElementById('transcript-response-container').innerHTML =
                        'Failed to generate transcript';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generate-summary-button').addEventListener('click', async function() {
                var videoId = this.getAttribute('data-video-id');

                // Tampilkan loading indicator
                document.getElementById('loading-summary').style.display = 'block';
                document.getElementById('summary-response-container').innerHTML = '';

                try {
                    var response = await axios.get('/generate-summary/' + videoId, {
                        timeout: 600000,
                        responseType: 'text'
                    });
                    document.getElementById('loading-summary').style.display = 'none';
                    document.getElementById('summary-response-container').innerHTML = response.data;
                } catch (error) {
                    document.getElementById('loading-summary').style.display = 'none';
                    document.getElementById('summary-response-container').innerHTML =
                        'Failed to generate summary';
                }
            });
        });
    </script>
@endsection
