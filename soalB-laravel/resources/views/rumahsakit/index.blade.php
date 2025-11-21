@extends('layouts.app')
@section('title','Data Rumah Sakit')
@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-md-6">
      <h2 class="text-primary">
        <i class="fas fa-hospital"></i> Data Rumah Sakit
      </h2>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('rumahsakit.create') }}" class="btn btn-success btn-lg">
        <i class="fas fa-plus"></i> Tambah Rumah Sakit
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead class="table-dark">
            <tr>
              <th><i class="fas fa-hashtag"></i> No</th>
              <th><i class="fas fa-building"></i> Nama</th>
              <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
              <th><i class="fas fa-envelope"></i> Email</th>
              <th><i class="fas fa-phone"></i> Telepon</th>
              <th><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data as $index => $d)
              <tr>
                <td>{{ $data->firstItem() + $index }}</td>
                <td>
                  <strong class="text-primary">{{ $d->nama }}</strong>
                </td>
                <td>{{ $d->alamat ?: '-' }}</td>
                <td>
                  @if($d->email)
                    <a href="mailto:{{ $d->email }}" class="text-decoration-none">
                      <i class="fas fa-envelope text-info"></i> {{ $d->email }}
                    </a>
                  @else
                    -
                  @endif
                </td>
                <td>{{ $d->telepon ?: '-' }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('rumahsakit.edit',$d->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('rumahsakit.destroy',$d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus rumah sakit ini?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-4">
                  <i class="fas fa-inbox fa-2x mb-2"></i>
                  <br>Belum ada data rumah sakit
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($data->hasPages())
        <div class="d-flex justify-content-center mt-3">
          {{ $data->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
  // Auto-hide alerts after 5 seconds
  setTimeout(function(){
    $('.alert').fadeOut('slow');
  }, 5000);
});
</script>
@endpush
