@extends('admin.layouts.app')

@section('content')
    <section class="card p-4">
        <h3>Create Course</h3>
        <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label>Course Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Input category name" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label class="w-100" id="description">Description<span class="text-danger">*</span>
                    <textarea rows="5" type="text" class="form-control @error('description') is-invalid @enderror"
                        name="description" value="{{ old('description') }}" placeholder="Masukkan deskripsi dari gambar yang sudah diinput"></textarea>
                </label>
                @if ($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Kategori</label>
                <select class="form-control" name="category_id">
                    <option>Pilih Kategori</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group mb-3">
                <label>Video<span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('video') is-invalid @enderror" placeholder=""
                    name="video" value="{{ old('video') }}">
                @if ($errors->has('video'))
                    <p class="text-danger">{{ $errors->first('video') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Transcript</label>
                <input type="text" class="form-control @error('transcript') is-invalid @enderror"
                    placeholder="Input trasncript" name="transcript" value="{{ old('transcript') }}">
                @if ($errors->has('transcript'))
                    <p class="text-danger">{{ $errors->first('transcript') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Summary</label>
                <input type="text" class="form-control @error('summary') is-invalid @enderror"
                    placeholder="Input summary" name="summary" value="{{ old('summary') }}">
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
