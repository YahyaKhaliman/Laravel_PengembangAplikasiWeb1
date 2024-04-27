<!-- Menghubungkan dengan view template master -->
@extends('template')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman Tentang')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

  <p>Selamat datang!</p>
  <p>Ini Adalah Halaman Tentang</p>
  <p>{{$isi_tentang}}</p>

@endsection
