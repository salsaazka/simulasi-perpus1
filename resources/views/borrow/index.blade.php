@extends('layouts.sidebar')

@section('content')
    <div>
        <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                            <h6>Data table</h6>
                           
                            <div class="d-flex">
                                @if(auth()->user()->role === 'user')
                                    <a href="{{ route('borrow.create') }}" class="btn add-new btn-success " style="margin-right: 5px"><i class="fa-solid fa-plus"></i></a>    
                                @endif
                                    <a href="{{ route('borrow.exportExcel') }}" class="btn add-new btn-success" style="margin-right: 5px"><i class="fa-solid fa-file-excel"></i></a>
                                    <a href="{{ route('borrow.exportPdf') }}" class="btn add-new btn-warning"><i class="fa-regular fa-file-pdf"></i></a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                NO</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                                User</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                                Book</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Start Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                End Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($dataBorrow as $borrow)
                                            <tr>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $no++ }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $borrow->user->name }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $borrow->book->title }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $borrow['start_date'] }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $borrow['end_date'] }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-10">{{ $borrow['status'] }}</td>
                                                <td class="d-flex">
                                                    {{-- Edit & Delete optional --}}
                                                    <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="/borrow/delete/{{ $borrow->id }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"  class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                    <form action="/borrow/return" method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Return</button>
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
    </div>
@endsection
