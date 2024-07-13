<!-- Menghubungkan dengan view template template -->
@extends('template')
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman form Register')
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
    Data berhasil Dimasukan
  </div>
@endif

<form action="{{url('save_register_api')}}" method="post" enctype = 'multipart/form-data' >
{{ csrf_field() }}
  <div class="mb-3">
    <label for="emailaddress" class="form-label">Email</label>
    <input type="email" class="form-control" id="emailaddress"  name="emailaddress">
  </div>
  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama"  name="nama">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password"  name="password">
  </div>
  <div class="mb-3">
    <label for="hak_akases" class="form-label">Jabatan</label>
    <select name="hak_akses" id="hak_akses" class="form-control" >
        <option value="superuser">Super User</option>
        <option value="direksi">Direksi</option>
        <option value="manager">Manager</option>
    </select>
  </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection


