@extends('layouts.sidebar')

@section('content')
    <div>
        @if (auth()->user()->role === 'admin')
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                            <h6>Data table</h6>
                            <div class="d-flex">
                                <a href="{{ route('book.create') }}" class="btn add-new btn-success " style="margin-right: 5px"><i
                                    class="fa-solid fa-plus"></i></a>
                                    <a href="{{ route('book.exportExcel') }}" class="btn add-new btn-success" style="margin-right: 5px"><i class="fa-solid fa-file-excel"></i></a>
                                    <a href="{{ route('book.exportPdf') }}" class="btn add-new btn-warning"><i class="fa-regular fa-file-pdf"></i></a>
                            </div>
                            
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                                Image</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                                Title</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Writer</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Publisher</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Year</th>
                                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Category</th> --}}
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataBook as $book)
                                        <tr>
                                        
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $no++ }}</td>
                                            <td>
                                                <img src="{{ asset('assets/img/data/'. $book['image']) }}" alt="Book Image" width="50" height="50">
                                            </td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $book['title'] }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $book['writer'] }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $book['publisher'] }}</td>
                                            <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $book['year'] }}</td>
                                            
                                            {{-- <td>{{ $book->category->name }}</td> --}}
                                            <td class="d-flex">
                                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="/book/delete/{{ $book->id }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->role === 'user')
        <div class="mt-4">
            <div class="w-100 container" style="margin-top: 6rem">
                <div>
                    <h3 class="text-center text-light fw-bold">List Book</h1>
                </div>

                <div class="d-flex flex-wrap">
                    {{-- @dd(Auth::user()) --}}
                    {{-- @dd($bookFilter) --}}
                    @foreach ($bookFilter as $item)
                        <div class="w-25 d-flex justify-content-center align-items-center">
                            <div class="card p-1" style="width: 95%">
                                <div class="w-100 overflow-hidden d-flex rounded position-relative"
                                    style="max-height: 275px; min-height: 275px">
                                    <img src="{{ url('assets/img/data/' . $item->image) }}"
                                        class="position-absolute min-w-100 max-w-100 "
                                        style="transform: translate(-50%, -50%); top: 50%; left: 50%;" alt="...">
                                </div>
                                <div class="card-body">
                                    <p class="mb-0 fw-bold" style="color: #1A1C19; font-size: 24px">
                                        {{ $item->title }}
                                    </p>
                                    <div class="mb-1 d-flex align-items-center">
                                        <p class="me-1 mb-0" style="color: #828282; font-size: 14px">
                                            {{ $item->writer }}
                                        </p>
                                        <p class="mb-0" style="color: #1A1C19; font-size: 14px">|</p>
                                        <i class="ms-1" style="color: #1A1C19; font-size: 14px">
                                            {{ $item->publisher }}
                                        </i>
                                    </div>
                                    <div class="mb-0 d-flex align-items-center">
                                        <img src="{{ asset('assets/img/star.png') }}" alt=""
                                            style="width: 24px; height: 24px">
                                        <p class="ms-1 mb-0" style="color: #1A1C19; font-size: 14px">
                                            {{ \App\Models\Review::with('book')->where('book_id', $item->id)->avg('rating') ?? 'Not Rated' }}
                                        </p>
                                    </div>
                                    <button class="btn btn-primary mt-3 mb-0" style="width: 100%" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-url="{{ route('borrow.borrowBook') }}"
                                        data-auth="{{ Auth::user()->id }}" data-book="{{ $item->id }}"
                                        data-img="{{ url('assets/img/data/' . $item->image) }}"
                                        data-review="{{ htmlspecialchars(json_encode(DB::table('reviews')->where('book_id', $item->id)->get()),ENT_QUOTES,'UTF-8') }}"
                                        data-title="{{ $item->title }}">
                                        Borrow
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content" id="modal-content">

                            {{-- content here --}}

                        </div>
                    </div>
                </div>
                <!-- End Modal Edit -->

            </div>
        </div>
    @endif
    </div>

    <script>
        $('#editModal').on('shown.bs.modal', function(e) {

            var html = `
        <div class="modal-content" id="modal-content">
                <div class="modal-body" style="height: 600px">
                    <form method="post" action="${$(e.relatedTarget).data('url')}">
                        @csrf
                        <div class="w-100">
                            <img src="${$(e.relatedTarget).data('img')}" class="" style="width: 100%; height: 400px" alt="...">
                            <p class="mb-0 fw-bold" style="color: #1A1C19; font-size: 24px">
                                ${$(e.relatedTarget).data('title')}
                            </p>
                            <div class="my-1 fw-bold" style="width: 100%; height: 1px; background-color: #1A1C19" />
                            <p class="pt-2" style="color: #1A1C19">List Comment</p>
                            <div id="review">

                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">Pinjam</button>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="${$(e.relatedTarget).data('auth')}">
                        <input type="hidden" name="book_id" value="${$(e.relatedTarget).data('book')}">
                        <input type="hidden" name="status" value="Dipinjam">
                       <div class="d-flex justify-content-end">
                        </div>
                    </form>
                </div>
            </div>
            `;

            $('#modal-content').html(html);

        });
    </script>
@endsection
