@extends('admin.layouts.app')

@section('content')
    <div class="d-flex flex-direction-row justify-content-end mb-3">
        <input class="form-control me-2 w-25" id="search" type="search" placeholder="Search" aria-label="Search">
    </div>
    {{-- <div class="toast align-items-center text-bg-success border-0 " id="toast" data-delay="3000" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body text-white fs-5">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div> --}}
    <div class="d-flex flex-row justify-content-between">
        <h3>Course</h3>
        <a class="btn btn-primary" href="{{ route('course.create') }}">Create Course</a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr class="fw-bold">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Ladder</th>
                <th scope="col">Action</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->category->namaKategori }}</td>
                    <td>
                        <a href="{{ route('course.show', $item->id) }}" class="btn btn-warning"><i
                                class="bi bi-eye fs-3"></i></a>
                        <a href="{{ route('course.edit', $item->id) }}" class="btn btn-success"><i
                                class="bi bi-pencil-square fs-3"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $item->id }}"><i class="bi bi-trash fs-3 ps-1"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-2" id="exampleModalLabel{{ $item->id }}">Peringatan
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-5">Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                        <form action="{{ route('course.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes! Im sure</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr id="no-results" class="d-none">
                <td colspan="5" class="text-center">Not Found</td>
            </tr>
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="pagination-links pagination-lg">
        {{ $data->links() }}
    </div>
    <script>
        const find = document.getElementById("search");
        const contents = document.querySelectorAll("tbody tr:not(#no-results)");
        const noResults = document.getElementById("no-results");

        find.addEventListener("input", (e) => findData(e.target.value));

        function findData(searchText) {
            let hasResults = false;

            contents.forEach((content) => {
                if (content.innerText.toLowerCase().includes(searchText.toLowerCase())) {
                    content.classList.remove("d-none");
                    hasResults = true;
                } else {
                    content.classList.add("d-none");
                }
            });

            if (hasResults) {
                noResults.classList.add("d-none");
            } else {
                noResults.classList.remove("d-none");
            }
        }
    </script>
@endsection
