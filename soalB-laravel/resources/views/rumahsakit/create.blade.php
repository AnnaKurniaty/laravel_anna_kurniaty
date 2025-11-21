@extends('layouts.app')

@section('title','Tambah Rumah Sakit')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">
            <i class="fas fa-plus-circle me-2"></i>Tambah Rumah Sakit
          </h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('rumahsakit.store') }}">
            @csrf

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">
                  <i class="fas fa-building text-primary me-1"></i>Nama Rumah Sakit *
                </label>
                <input name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" required placeholder="Masukkan nama rumah sakit">
                @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">
                  <i class="fas fa-envelope text-info me-1"></i>Email
                </label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="contoh@email.com">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">
                  <i class="fas fa-phone text-success me-1"></i>Telepon
                </label>
                <input name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                       value="{{ old('telepon') }}" placeholder="08123456789">
                @error('telepon')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">
                  <i class="fas fa-map-marker-alt text-danger me-1"></i>Alamat
                </label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                          rows="1" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                @error('alamat')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                  </button>
                  <a href="{{ route('rumahsakit.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
