  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">User  Melewati Batas Pinjam  </span>
          <div class="dropdown-divider"></div>
              @forelse (dataPassDay() as $data)
              <a href="#" class="dropdown-item">
                <i class="fas fa-user text-danger mr-1"></i> {{ $data->anggota->name }}
                <span class="float-right text-muted text-sm">{{ $data->lama_lewat }} hari</span>
              </a>
              @empty
              <span class="dropdown-item dropdown-header">Belum ada   </span>
              @endforelse
          <div class="dropdown-divider"></div>
        </div>
      </li>
        <li class="nav-item ">
          <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn">Logout</button>
          </form>
        </li>
    </ul>

  </nav>
  <!-- /.navbar -->