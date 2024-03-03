@extends('layouts.sidebar')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('book.store') }}" method="post"  enctype="multipart/form-data" class="mb-3 mt-4">
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >Judul</label
            >
            <input
              type="text"
              class="form-control"
              name="title"
              aria-describedby="title"
              placeholder="Masukan Judul"
            />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >Penulis</label
            >
            <input
              type="text"
              class="form-control"
              name="writer"
              aria-describedby="writer"
              placeholder="Masukan Penulis"
            />
          </div>
    
        </div>
      </div>

      <div class="mb-3">
        <label for="" class="form-label"
          >Upload Image</label
        >
        <input type="file" name="image" class="form-control" id="inputGroupFile02">
      </div>

      <div class="row">
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >Penerbit</label
            >
            <input
              type="text"
              class="form-control"
              name="publisher"
              aria-describedby="publisher"
              placeholder="Masukan Penerbit"
            />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label for="" class="form-label"
              >Tahun terbit</label
            >
            <input
              type="date"
              class="form-control"
              name="year"
              aria-describedby="year"
              placeholder="Masukan Tahun Terbit"
            />
          </div>
        </div>
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