@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3">Register</h4>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" value="{{ old('username') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Register</button>
        </form>

        <div class="mt-3 text-center">
          <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
