@extends('layouts.app')
@section('content')
<h3>Data Rumah Sakit</h3>
<a href="{{ route('rumahsakit.create') }}" class="btn btn-success mb-2">Tambah</a>

<table class="table table-bordered">
  <thead><tr><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Aksi</th></tr></thead>
  <tbody>
    @foreach($data as $d)
      <tr>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->alamat }}</td>
        <td>{{ $d->email }}</td>
        <td>{{ $d->telepon }}</td>
        <td>
          <a class="btn btn-sm btn-primary" href="{{ route('rumahsakit.edit',$d->id) }}">Edit</a>
          <form action="{{ route('rumahsakit.destroy',$d->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $data->links() }}
@endsection
