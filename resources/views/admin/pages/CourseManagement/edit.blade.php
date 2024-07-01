@extends('admin.layouts.app')

@section('content')
    <section class="card p-4">
        <h3>Edit Course</h3>
        <form action="{{ route('course.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Course Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Input category name" name="name" value="{{ $data->name }}">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Description<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Input description from category" name="description" value="{{ $data->description }}">
                @if ($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Kategori</label>
                <select class="form-control" name="category_id">
                    <option>Pilih Kategori</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" @selected($item->id == $data->category_id)>{{ $item->namaKategori }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group mb-3">
                <label>Video<span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('video') is-invalid @enderror" placeholder=""
                    name="video">
                @if ($errors->has('video'))
                    <p class="text-danger">{{ $errors->first('video') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Transcript</label>
                <input type="text" class="form-control @error('transcript') is-invalid @enderror"
                    placeholder="Input trasncript" name="transcript" value="{{ $data->transcript }}">
                @if ($errors->has('transcript'))
                    <p class="text-danger">{{ $errors->first('transcript') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Summary</label>
                <input type="text" class="form-control @error('summary') is-invalid @enderror"
                    placeholder="Input summary" name="summary" value="{{ $data->summary }}">
                @if ($errors->has('summary'))
                    <p class="text-danger">{{ $errors->first('summary') }}</p>
                @endif
            </div>
            <div class="d-flex gap-3 justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('course.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
