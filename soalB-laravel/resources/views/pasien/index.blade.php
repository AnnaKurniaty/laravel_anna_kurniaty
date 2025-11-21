@extends('layouts.app')

@section('title','Data Pasien')

@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-md-6">
      <h2 class="text-primary">
        <i class="fas fa-users"></i> Data Pasien
      </h2>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('pasien.create') }}" class="btn btn-success btn-lg">
        <i class="fas fa-plus"></i> Tambah Pasien
      </a>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <label class="form-label fw-bold">
            <i class="fas fa-filter text-primary me-1"></i>Filter Rumah Sakit
          </label>
          <select id="filterRS" class="form-select">
            <option value="">-- Semua Rumah Sakit --</option>
            @foreach($rs as $r)
              <option value="{{ $r->id }}">{{ $r->nama }}</option>
            @endforeach
          </select>
        </div>
      </div>
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
        <table class="table table-hover table-striped" id="tablePasien">
          <thead class="table-dark">
            <tr>
              <th><i class="fas fa-hashtag"></i> No</th>
              <th><i class="fas fa-user"></i> Nama</th>
              <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
              <th><i class="fas fa-phone"></i> Telepon</th>
              <th><i class="fas fa-hospital"></i> Rumah Sakit</th>
              <th><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pasiens as $index => $p)
              <tr id="row-{{ $p->id }}">
                <td>{{ $pasiens->firstItem() + $index }}</td>
                <td>
                  <strong class="text-primary">{{ $p->nama }}</strong>
                </td>
                <td>{{ $p->alamat ?: '-' }}</td>
                <td>{{ $p->telepon ?: '-' }}</td>
                <td>
                  @if($p->rumahSakit)
                    <span class="badge bg-info">
                      <i class="fas fa-hospital me-1"></i>{{ $p->rumahSakit->nama }}
                    </span>
                  @else
                    <span class="badge bg-secondary">-</span>
                  @endif
                </td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('pasien.edit',$p->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $p->id }}" title="Hapus">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-4">
                  <i class="fas fa-users fa-2x mb-2"></i>
                  <br>Belum ada data pasien
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($pasiens->hasPages())
        <div class="d-flex justify-content-center mt-3">
          {{ $pasiens->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
  setTimeout(function(){
    $('.alert').fadeOut('slow');
  }, 5000);

  $('#filterRS').change(function(){
    var rsId = $(this).val();
    $.ajax({
      url: '{{ route("filter-pasien") }}',
      type: 'GET',
      data: { id: rsId },
      success: function(data){
        var tbody = $('#tablePasien tbody');
        tbody.empty();
        if(data.data && data.data.length > 0){
          data.data.forEach(function(p, index){
            var no = (data.current_page - 1) * data.per_page + index + 1;
            var rsBadge = p.rumah_sakit ? '<span class="badge bg-info"><i class="fas fa-hospital me-1"></i>' + p.rumah_sakit.nama + '</span>' : '<span class="badge bg-secondary">-</span>';
            var row = '<tr id="row-' + p.id + '">' +
              '<td>' + no + '</td>' +
              '<td><strong class="text-primary">' + p.nama + '</strong></td>' +
              '<td>' + (p.alamat || '-') + '</td>' +
              '<td>' + (p.telepon || '-') + '</td>' +
              '<td>' + rsBadge + '</td>' +
              '<td>' +
                '<div class="btn-group" role="group">' +
                  '<a href="{{ url("pasien") }}/' + p.id + '/edit" class="btn btn-sm btn-outline-primary" title="Edit">' +
                    '<i class="fas fa-edit"></i>' +
                  '</a>' +
                  '<button class="btn btn-sm btn-outline-danger btn-delete" data-id="' + p.id + '" title="Hapus">' +
                    '<i class="fas fa-trash"></i>' +
                  '</button>' +
                '</div>' +
              '</td>' +
            '</tr>';
            tbody.append(row);
          });
        } else {
          tbody.append('<tr><td colspan="6" class="text-center text-muted py-4"><i class="fas fa-users fa-2x mb-2"></i><br>Tidak ada data pasien untuk rumah sakit ini</td></tr>');
        }
      }
    });
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    if(confirm('Yakin hapus pasien ini?')){
      $.ajax({
        url: '{{ url("pasien-ajax") }}/' + id,
        type: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(){
          $('#row-' + id).fadeOut();
          if (!$('.alert').length) {
            $('.card-body').prepend('<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i> Pasien berhasil dihapus<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
          }
        }
      });
    }
  });
});
</script>
@endpush
