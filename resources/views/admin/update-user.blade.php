@extends('layouts.sidebar')

@section('content')
<div class="card">
    <div class="card-body">
        <form role="form" action="{{ route('dashboard.updateUser', $dataUser->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name" value="{{ $dataUser->name }}">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" value="{{ $dataUser->username }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Address" aria-label="Address" name="address" value="{{ $dataUser->address }}">
              </div>
            </div>
            <div class="col-6">
              <label class="form-label text-muted">Role</label>
              <select class="form-select" aria-label="Default select example" name="role">
                  <option value="User" {{ $dataUser->role == 'User' ? 'selected' : '' }}>User</option>
                  <option value="Officer" {{ $dataUser->role == 'Officer' ? 'selected' : '' }}>Officer</option>
                  <option value="Admin" {{ $dataUser->role == 'Admin' ? 'selected' : '' }}>Admin</option>
              </select>
          </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" value="{{ $dataUser->email }}">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" value="{{ $dataUser->password }}">
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