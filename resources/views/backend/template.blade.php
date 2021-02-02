<!DOCTYPE html>
<html lang="en">
    <!-- include dibawah memanggil file header yg ada pada folder component -->
  @include('backend.component.header')
<body class="hold-transition sidebar-mini layout-fixed">

<!-- file jquery dan file javascript -->
  @include('backend.component.script')
<div class="wrapper">
  <!-- Menu Navbar -->
  @include('backend.component.navbar')
  <!-- /.navbar -->
  <br>

  <!-- Menu Sidebar / Navigator Menu -->
  @include('backend.component.menu')

  <!-- Content -->
  <div class="content-wrapper">
    @yield('content-header')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- yield dibawah berfungsi menampilkan halaman secara dinamis -->
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content -->

  <!-- Menu Footer -->
  @include('backend.component.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
