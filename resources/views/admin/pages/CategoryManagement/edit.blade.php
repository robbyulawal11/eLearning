@extends('admin.layouts.app')
@section('content')
    <section class="card p-4">
        <h3>Edit Category</h3>
        <form action="{{ route('category.update', $data->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group mb-3">
                <label>Category Name <span class="text-danger">*</span></label>
                <input type="integer" class="form-control @error('namaKategori') is-invalid @enderror"
                    placeholder="Masukkan nama kategori" name="namaKategori" value="{{ $data->namaKategori }}">
            </div>
            <div class="form-group mb-3">
                <label>Description<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('descKategori') is-invalid @enderror"
                    placeholder="Masukkan deksripsi dari kategori" name="descKategori" value="{{ $data->descKategori }}">
            </div>
            <div class="d-flex gap-3 justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
@endsection
