<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/bappenas_logo1.png" alt="Bappenas Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Asset Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{session('nama')}} <span class="float-right"><i class="fa fa-online"></i></a> </span>
          @if(session('level') == 1)
          <!-- <i class="d-ilock" style="color:white">Superadmin</i> -->
          @elseif(session('level') == 2)
          <i class="d-block" style="color:white">Teknisi</i>
          @elseif(session('level') == 3)
          <i class="d-block" style="color:white">User</i>
          @endif
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/" class="nav-link active">
            <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left" ></i> -->
              </p>
            </a>
          </li>
          @if(session('level') == 1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('pegawai')}}" class="nav-link">
                <i class="nav-icon fas fa-user" aria-hidden="true"></i>
                  <p>Pegawai</p>
                </a>
              </li>
              <!-- data kategori -->
              <li class="nav-item">
                <a href="{{route('kategori')}}" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <i class="nav-icon fas fa-list-alt" aria-hidden="true"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <!-- data satuan -->
              <li class="nav-item">
                <a href="{{route('satuan')}}" class="nav-link">
                <i class="nav-icon fas fa-th-list" aria-hidden="true"></i>
                  <p> Satuan</p>
                </a>
              </li>
              <!-- data departement -->
              <li class="nav-item">
                <a href="{{route('departement')}}" class="nav-link">
                <i class="nav-icon fas fa-university" aria-hidden="true"></i>
                  <p> Department</p>
                </a>
              </li>
              <!-- data type permohonan -->
              <li class="nav-item">
                <a href="{{route('type-permohonan')}}" class="nav-link">
                <i class="nav-icon fas fa-file" aria-hidden="true"></i>
                  <p> Type Permohonan</p>
                </a>
              </li>
            </ul>
             <ul class="nav nav-treeview">
            </ul>
          </li>
          @endif
          <li class="nav-item">
              <a href="{{route('data-aset')}}" class="nav-link">
              <i class="nav-icon fas fa-desktop" aria-hidden="true"></i>
                <p>Data Aset</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{route('permohonan')}}" class="nav-link">
              <i class="nav-icon fas fa-file" aria-hidden="true"></i>
                <p>Permohonan</p>
                @if(session('status') == 2)
                <span class="badge badge-warning">0</span>
                @endif
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>