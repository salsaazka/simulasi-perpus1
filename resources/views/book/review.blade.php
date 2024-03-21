@extends('layouts.sidebar')

@section('content')
    <div class="mt-5">
        <div class="w-100 container" style="margin-top: 6rem">
            <div>
                <h3 class="text-center text-light fw-bold">List Book</h1>
            </div>

            <div class="card w-100">
                <div class="card-body w-100">
                    <div class="d-flex">
                        <div class="w-25 pe-4">
                            <img src="{{ asset('assets/img/data/' . $dataBook->image) }}" style="max-width: 100%"
                                alt="">
                        </div>
                        <div class="w-75 ps-4">
                            @if (DB::table('reviews')->where('book_id', $dataBook->id)->get()->count() > 0)
                                @foreach (DB::table('reviews')->where('book_id', $dataBook->id)->get() as $review)
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <img src="{{ asset('assets/img/star.png') }}" alt="Star Filled"
                                                        style="width: 20px; height: 20px">
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="my-2">{{ $review->review }}</p>
                                        <div style="width: 100%; height: 1px; background-color: #1A1C19"></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
