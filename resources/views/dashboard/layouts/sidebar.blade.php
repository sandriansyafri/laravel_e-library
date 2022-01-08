  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text">PUSTAKA <span class="font-weight-bold">KU</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('peminjaman') }}" class="nav-link {{ request()->is('peminjaman') ? 'active' : '' }}">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>
                      Peminjaman
                  </p>
                </a>
              </li>

               <li class="nav-item menu-is-opening menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Data Master
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: block;">

                  <li class="nav-item">
                    <a 
                      href="{{ route('anggota') }}" 
                      class="nav-link {{ (request()->is('anggota') ? 'active' : '') || request()->is('data/anggota*') ? 'active' : '' }}">
                      <i class="fas fa-users nav-icon" ></i>
                        <p>Anggota</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a 
                      href="{{ route('katalog') }}" 
                      class="nav-link {{ (request()->is('katalog') ? 'active' : '') || request()->is('data/katalog*') ? 'active' : '' }}">
                      <i class="fas fa-book-open nav-icon"></i>
                        <p>Katalog</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a 
                      href="{{ route('penerbit') }}" 
                      class="nav-link {{ (request()->is('penerbit') ? 'active' : '') || request()->is('data/penerbit*') ? 'active' : '' }}">
                      <i class="fas fa-book-open nav-icon"></i>
                        <p>Penerbit</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a 
                      href="{{ url('pengarang') }}" 
                      class="nav-link {{ (request()->is('pengarang') ? 'active' : '') || request()->is('data/pengarang*') ? 'active' : '' }}">
                      <i class="fas fa-book-open nav-icon"></i>
                        <p>Pengarang</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a 
                      href="{{ url('buku') }}" 
                      class="nav-link {{ (request()->is('buku') ? 'active' : '') || request()->is('data/buku*') ? 'active' : '' }}">
                      <i class="fas fa-book nav-icon"></i>
                        <p>Buku</p>
                    </a>
                  </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>