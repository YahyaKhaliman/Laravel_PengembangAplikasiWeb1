<!-- Menghubungkan dengan view template master -->
@extends('template')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'View Data')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')

@if ($errors->any())
    <div class='alert alert-danger'>
        <ul>
            @foreach ($errors->all() as $errors)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class='alert alert-success'>
        {{ session('success') }}
    </div>
@endif

<div class='table-responsive'>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col'>No</th>
                <th scope='col'>Foto</th> 
                <th scope='col'>Nama</th>
                <th scope='col'>Email</th>
                <th scope='col'>Hak Akses</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @if($row->foto)
                            <img src="{{ asset('storage/image/' . $row->foto) }}" alt="Foto" width="50" height="50">
                        @endif
                    </td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->hak_akses }}</td>
                    <td>
                        <a href='{{ url("form_update/{$row->user_id}") }}' class='btn btn-primary'>Update</a>
                        <form action='{{ url("hapus_data/{$row->user_id}") }}' method='POST' style='display:inline'>
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger' type='submit' onclick='return confirm("Are you sure to delete?")'>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection