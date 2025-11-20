@extends('layouts.app')

@section('title','Data Pasien')

@section('content')
<h3>Data Pasien</h3>

<div class="row mb-3">
  <div class="col-md-4">
    <select id="filterRS" class="form-select">
      <option value="">-- Semua Rumah Sakit --</option>
      @foreach($rs as $r)
        <option value="{{ $r->id }}">{{ $r->nama }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-8 text-end">
    <a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah Pasien</a>
  </div>
</div>

<table class="table table-bordered" id="tablePasien">
  <thead class="table-light">
    <tr><th>Nama</th><th>Alamat</th><th>Telepon</th><th>Rumah Sakit</th><th>Aksi</th></tr>
  </thead>
  <tbody>
    @foreach($pasiens as $p)
      <tr id="row-{{ $p->id }}">
        <td>{{ $p->nama }}</td>
        <td>{{ $p->alamat }}</td>
        <td>{{ $p->telepon }}</td>
        <td>{{ $p->rumahSakit->nama ?? '-' }}</td>
        <td>
          <a href="{{ route('pasien.edit',$p->id) }}" class="btn btn-sm btn-primary">Edit</a>
          <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $p->id }}">Delete</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $pasiens->links() }}

@endsection

@push('scripts')
<script>
$(function(){
  // set csrf untuk ajax
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  // AJAX delete
  $('.btn-delete').on('click', function(){
    if (!confirm('Yakin hapus?')) return;
    var id = $(this).data('id');
    $.ajax({
      url: '/pasien-ajax/' + id,
      type: 'DELETE',
      success: function(res){
        $('#row-'+id).remove();
      },
      error: function(){
        alert('Gagal menghapus');
      }
    });
  });

  // Filter dropdown
  $('#filterRS').on('change', function(){
    var id = $(this).val();
    $.get('{{ route("pasien.filter") }}', { id: id }, function(data){
      var html = '';
      data.forEach(function(p){
        html += '<tr id="row-'+p.id+'">';
        html += '<td>'+p.nama+'</td>';
        html += '<td>'+ (p.alamat||'') +'</td>';
        html += '<td>'+ (p.telepon||'') +'</td>';
        html += '<td>'+ (p.rumah_sakit ? p.rumah_sakit.nama : '') +'</td>';
        html += '<td><a href="/pasien/'+p.id+'/edit" class="btn btn-sm btn-primary">Edit</a> ';
        html += '<button class="btn btn-sm btn-danger btn-delete" data-id="'+p.id+'">Delete</button></td>';
        html += '</tr>';
      });
      $('#tablePasien tbody').html(html);
    });
  });

  // re-bind delete after filter (delegation)
  $('#tablePasien').on('click', '.btn-delete', function(){
    if (!confirm('Yakin hapus?')) return;
    var id = $(this).data('id');
    $.ajax({
      url: '/pasien-ajax/' + id,
      type: 'DELETE',
      success: function(res){
        $('#row-'+id).remove();
      }
    });
  });

});
</script>
@endpush
