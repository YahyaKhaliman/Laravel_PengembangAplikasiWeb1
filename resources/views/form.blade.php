<!-- Menghubungkan dengan view template template -->
@extends('template')
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman form')
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
    {{ session()->get('nama') }}  {{ session()->get('telp') }} {{ session()->get('success') }}
  </div>
  @endif
  
  <form action="{{url('add_form')}}" method="post">
  {{ csrf_field() }} <!-- wajib diberikan jika menggunakan method post -->
  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama"  name="nama">
    
  </div>
  <div class="mb-3">
    <label for="telp" class="form-label">No telp</label>
    <input type="text" class="form-control" id="telp" name="telp">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
