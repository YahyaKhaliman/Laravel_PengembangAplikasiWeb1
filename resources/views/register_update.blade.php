<!-- Menghubungkan dengan view template template -->
@extends('template')
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman form Update Register')
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


@php 
    $select1 = "";  $select2 = "";  $select3 = "";
  @endphp
  @if($detail_data['hak_akses']=="superuser")     
    @php 
    $select1 = "selected";
@endphp

@endif
  @if($detail_data['hak_akses']=="direksi") 
  @php 
    $select2 = "selected";
  @endphp
@endif

@if($detail_data['hak_akses']=="manager") 
  @php 
    $select3 = "selected";
  @endphp
@endif

<form action="{{url('save_update')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('PUT')
    <div class="mb-3">
        <label for="emailaddress" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailaddress" name="emailaddress" value="{{ $detail_data['email'] }}">
        <input type="hidden" class="form-control" id="foto_old" name="foto_old" value="{{ $detail_data['foto'] }}">
        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $detail_data['user_id'] }}">
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $detail_data['nama'] }}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="hak_akses" class="form-label">Jabatan</label>
        <select name="hak_akses" id="hak_akses" class="form-control">
            <option value="superuser" {{ $select1 }}>Super User</option>
            <option value="direksi" {{ $select2 }}>Direksi</option>
            <option value="manager" {{ $select3 }}>Manager</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image" class="col-form-label">Foto:</label><br>
        <img src="{{ asset('storage/image/' . $detail_data['foto']) }}" style="width:100px" class="img-fluid" alt="Foto">
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
