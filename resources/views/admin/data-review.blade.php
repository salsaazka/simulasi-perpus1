@extends('layouts.sidebar')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h6>Data table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            User</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Book</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Rating</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($dataReview as $review)
                                    <tr>
                                        <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $no++ }}</td>
                                        <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $review->user->name }}</td>
                                        <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $review->book->title }}</td>
                                        <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $review['rating'] }}</td>
                                        <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $review['review'] }}</td>
                                        {{-- <td class="d-flex">
                                            <a href="{{ route('review.edit', $review->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="/review/delete/{{ $review->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection