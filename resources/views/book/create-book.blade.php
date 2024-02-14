@extends('layouts.index')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('book.store') }}" method="post" class="mb-3 mt-4">
      @csrf
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

      <div class="mb-3">
        <label for="" class="form-label"
          >Upload Image</label
        >
        <input type="file" name="image" class="form-control" id="inputGroupFile02">
      </div>

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
      {{-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"
          >NISN</label
        >
        <input
          type="number"
          class="form-control"
          name="nisn"
          aria-describedby="nisn"
          placeholder="Masukan NISN"
        />
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"
          >Jenis Kelamin</label
        >
        <select class="form-select" aria-label="jk" name="jk">
          <option selected>Pilih Jenis Kelamin</option>
          <option value="laki-laki">Laki-laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Alamat</label>
        <div class="form-floating">
          <textarea
            name="address"
            class="form-control"
            placeholder="address"
            id="address"
          ></textarea>
          <label for="address">Masukan Alamat Anda</label>
        </div>
      </div> --}}

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