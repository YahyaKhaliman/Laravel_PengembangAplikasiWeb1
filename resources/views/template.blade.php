<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Belajar memasang template Laravel Amikom Surakarta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
  crossorigin="anonymous">
  <!-- <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"  > -->

</head>
<body  >
@include('menu')
  <hr/>
  <!-- bagian ini menampilkan judul halaman profile -->
  <h3> @yield('judul') </h3>
  <!-- bagian ini menampung konten  -->
  @yield('konten')
  <br/>
  <hr/>   
  <footer class="footer mt-auto py-3 bg-success fixed-bottom text-white ">
  <div class="container">
    <span class="text-white">@kursus_komputer_soloraya 2025</span>
  </div>
</footer>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js') }}"></script>