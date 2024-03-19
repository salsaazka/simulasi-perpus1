@extends('layouts.sidebar')

@section('content')
<div class="card">
    <div class="card-body">
        <form role="form" action="{{ route('dashboard.createUser') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name">
              </div> 
            </div>
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Address" aria-label="Address" name="address">
              </div>
            </div>
            <div class="col-6">
              <label
                  class="form-label text-muted">Role</label>
              <select class="form-select" aria-label="Default select example" name="region">
                  <option selected>--Select--</option>
                  <option value="Cis 1">User</option>
                  <option value="Cis 2">Officer</option>
                  <option value="Cis 3">Admin</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password">
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Submit</button>
          </div>
        </form>
    </div>
</div>

@endsection