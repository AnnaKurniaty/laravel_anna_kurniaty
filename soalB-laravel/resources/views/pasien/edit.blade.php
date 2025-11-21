@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Edit Pasien</h3>
  <form method="POST" action="{{ route('pasien.update', $p->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" value="{{ $p->nama }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input name="alamat" class="form-control" value="{{ $p->alamat }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input name="telepon" class="form-control" value="{{ $p->telepon }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Rumah Sakit</label>
      <select name="rumah_sakit_id" class="form-select" required>
        <option value="">-- Pilih Rumah Sakit --</option>
        @foreach($rs as $r)
          <option value="{{ $r->id }}" {{ $p->rumah_sakit_id == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
        @endforeach
      </select>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
