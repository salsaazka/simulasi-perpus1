@extends('layouts.sidebar')

@section('content')
    <div>
        <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                            <h6>Data table</h6>
                            <a href="{{ route('category.create') }}" class="btn add-new btn-success m-1 float-end"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                NO</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">
                                                Book Category</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($dataCategory as $category)
                                            <tr>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-9">{{ $no++ }}</td>
                                                <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-9">{{ $category['name'] }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="/category/delete/{{ $category->id }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"  class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
