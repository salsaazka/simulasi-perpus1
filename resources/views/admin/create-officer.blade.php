@extends('layouts.index')

@section('content')
<div class="card">
    <div class="card-body">
        <form role="form" action="{{ route('dashboard.createOfficer') }}" method="POST">
          @csrf
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Address" aria-label="Address" name="address">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password">
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Submit</button>
          </div>
        </form>
    </div>
</div>

@endsection