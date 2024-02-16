@extends('layouts.index')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('category.store') }}" method="post" class="mb-3 mt-4">
      @csrf
      <div class="mb-3">
        <label for="" class="form-label"
          >Name Category</label
        >
        <input
          type="text"
          class="form-control"
          name="name"
          aria-describedby="Name Category"
          placeholder="Masukan Nama Kategori"
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