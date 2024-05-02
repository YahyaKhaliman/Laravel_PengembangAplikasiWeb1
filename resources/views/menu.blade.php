<nav class="navbar navbar-expand-lg navbar-dark bg-success  ">
  <div class="container-fluid">
    <a class="navbar-brand navbar-text text-white" href="#">Kursus komputer soloraya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" 
    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll " style="--bs-scroll-height: 100px;">
        <li class="nav-item ">
          <a class="nav-link active navbar-text text-white " aria-current="page" href="{{url('dashboard')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('tentang')}}">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('kontak')}}">Kontak</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Link dropdown
          </a>
          <ul class="dropdown-menu">
            @if(Auth::user()->hak_akses=='superuser')
            <li><a class="dropdown-item" href="{{url('form')}}">form</a></li>
            @endif
            <li><a class="dropdown-item" href="{{url('register')}}">register</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Link</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
