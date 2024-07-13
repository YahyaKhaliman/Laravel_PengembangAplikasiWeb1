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
            <li><a class="dropdown-item" href="{{url('form')}}">Form</a></li>
            <li><a class="dropdown-item" href="{{url('view_data')}}">Data</a></li>
            <li><a class="dropdown-item" href="{{url('view_page_data')}}">Data With Pagination</a></li>
            <li><a class="dropdown-item" href="{{url('register')}}">Register</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Link</a>
        </li>
        <li class="nav-item" >
          <form id="logout-form" action="{{ url('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
              @csrf
              <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
      </li>
      </ul>
    </div>
  </div>
</nav>
