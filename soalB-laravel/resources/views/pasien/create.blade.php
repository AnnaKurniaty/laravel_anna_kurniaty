@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Tambah Pasien</h3>
  <form method="POST" action="{{ route('pasien.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input name="alamat" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Telepon</label>
      <input name="telepon" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Rumah Sakit</label>
      <select name="rumah_sakit_id" class="form-select" required>
        <option value="">-- Pilih Rumah Sakit --</option>
        @foreach($rs as $r)
          <option value="{{ $r->id }}">{{ $r->nama }}</option>
        @endforeach
      </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
