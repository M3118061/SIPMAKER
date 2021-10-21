<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <span class="brand-text font-weight-light"><i class="nav-icon fas fa-home"> &nbsp;SIPMAKER</i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <ul class="navbar-nav ml-auto">
            <div class="d-flex">
              <div class="info">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"></a>
                        </li>
                    @endif

                @else
                    <li>
                        <a href="{{ route('setting.akun') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                @endguest
              </div>
            </div>
        </ul>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon classwith font-awesome or any other icon font library -->
          
          @if (auth()->user()->role == 'Admin')
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Users
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/jenis') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Jenis
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/satuan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Satuan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/dataBarang') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Barang
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/supplier') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Supplier
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/gudang') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Gudang
                  </p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (auth()->user()->role == 'Manajer')
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/laporanStok') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/laporanMasuk') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/laporanKeluar') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (auth()->user()->role == "Pegawai")
            {{--  <li class="nav-item">
              <a href="/home/{{$id_gudang}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>  --}}
            <li class="nav-item">
              <a href="/menugudang" class="nav-link">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Menu Gudang
                </p>
              </a>
            </li>
          @endif

          {{-- <li class="nav-item">
            <a href="{{ route('setting.akun') }}" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Akun
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
