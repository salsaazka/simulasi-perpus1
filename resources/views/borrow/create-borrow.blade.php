@extends('layouts.index')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('borrow.store') }}" method="post" class="mb-3 mt-4">
      @csrf
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"
          >Nama Buku</label
        >
        <input
          type="text"
          class="form-control"
          name="book_id"
          aria-describedby="name book"
          placeholder="Masukan Nama Buku"
        />
      </div>
      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >Start Date</label
            >
            <input
              type="date"
              class="form-control"
              name="start_date"
              aria-describedby=""
              placeholder="Start Date"
            />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >End Date</label
            >
            <input
              type="date"
              class="form-control"
              name="end_date"
              aria-describedby="end_date"
              placeholder="End Date"
            />
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="" class="form-label"
          >Status</label
        >
        <input
          type="radio"
          class="for-idm-control"
          name="status"
          aria-describedby="status"
          placeholder="Masukan Status"
        />
      </div>

      <button
        type="submit"
        class="btn text-white mb-5"
        style="background-color: #B46060"
      >
        Submit
      </button>
    </form>
  </div>
</div>

    
@endsection