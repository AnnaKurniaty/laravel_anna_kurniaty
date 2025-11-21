@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Edit Rumah Sakit</h3>
  <form method="POST" action="{{ route('rumahsakit.update', $item->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" value="{{ $item->nama }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input name="alamat" class="form-control" value="{{ $item->alamat }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" value="{{ $item->email }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input name="telepon" class="form-control" value="{{ $item->telepon }}">
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('rumahsakit.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
