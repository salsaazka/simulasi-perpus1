@extends('layouts.index')

@section('content')
<div>
  @if(auth()->user()->role === 'admin')
    <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                      <h6>Data table</h6>
                      <a href="{{ route('dashboard.officer') }}" class="btn add-new btn-success m-1 float-end"><i
                              class="fa-solid fa-plus"></i></a>
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                          <table class="table align-items-center mb-0">
                              <thead>
                                  <tr>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          NO</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                          Name</th>
                                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          Email</th>
                                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          Address</th>
                                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php
                                      $no = 1;
                                  @endphp

                                  @foreach ($dataOffice as $officer)
                                      <tr>
                                          <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{ $no++ }}</td>
                                          <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{ $officer['name'] }}</td>
                                          <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{ $officer['username'] }}</td>
                                          <td class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{ $officer['email'] }}</td>
                                          <td  class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">{{ $officer['address'] }}</td>
                                          <td class="d-flex">
                                              {{-- <a href="{{ route('officer.edit', $officer->id) }}" class="btn btn-warning" style="margin-right: 5px"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                              <form action="/delete-officer/{{ $officer->id }}" method="POST">
                                                  @method('DELETE')
                                                  @csrf
                                                  <button type="submit"  class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                              </form> 
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
    @if(auth()->user()->role === 'admin' && 'user' && 'officer')
    <div class="mt-4">
      <h3 class=" text-primary text-center">
          <strong>Buku Tersedia</strong>
      </h3>
      {{-- <div class="d-flex flex-wrap justify-content-around">
        @foreach ($book as $item)
            <a class="card me-2 mt-3" href="{{ route('bookDetail', $item->id) }}" style="width: 23%">
                <img src="{{ url('assets/img/data/' . $item->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text" style="text-decoration: none">{{ $item->title }}</p>
                </div>
            </a>
        @endforeach
      </div>
      <div class="d-flex justify-content-center">
          <a href="" class="btn btn-primary mt-3">Lihat Semua</a>
      </div> --}}
  </div>
  @endif
</div>
@endsection
