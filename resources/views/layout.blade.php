
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lost and Found System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>-->
    </ul>

    <!-- Right navbar links--> 
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link text-center">
      <!--<img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <span class="brand-text font-weight-light">Lost And Found</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/boxed-bg.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{url('profile')}}" class="d-block" onclick="modalProfile()">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            
            @if(in_array(Auth::user()->role, [3,2]))
            <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Dashboard
              </p>
            </a>
            </li>
            @endif
            
            @if (Auth::user()->role==1)
            <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Dashboard
              </p>
            </a>
            </li>
            @endif
            
            @if(in_array(Auth::user()->role, [3,2]))
          <li class="nav-item">
            <a href="{{url('admin/setting/category')}}" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/setting/location')}}" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Location
              </p>
            </a>
          </li>
            @endif
            
            @if(in_array(Auth::user()->role, [3,2]))
          <li class="nav-item">
            <a href="{{url('admin/item')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Item
              </p>
            </a>
          </li>
            @endif
            
            @if(in_array(Auth::user()->role, [3,2]))
          <li class="nav-item">
            <a href="{{url('admin/request')}}" class="nav-link">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>
                Claim
              </p>
            </a>
          </li>
            @endif
            @if(Auth::user()->role==1)
            <li class="nav-item">
            <a href="{{url('lostitem')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Item Found
              </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->role==1)
            <li class="nav-item">
            <a href="{{url('clientreport')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Report an Item
              </p>
            </a>
            </li>
            @endif
            
            @if(Auth::user()->role==1)
          <li class="nav-item">
            <a href="{{url('clientrequest')}}" class="nav-link">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>
                Claim
              </p>
            </a>
          </li>
            @endif
            @if(Auth::user()->role==3)
          <li class="nav-item">
            <a href="{{url('admin/checkuser')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
            @endif
          <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @yield('content')
  </div>
  <!-- /.content-wrapper -->

    <!--<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <div id="variable"></div>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<!--<script src="https://gist.github.com/AmirolAhmad/85407fccc6ee5ecc7924.js"></script>-->
@yield('postscript')
<script>
modalProfile = () => {
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/modal-profile') }}",
                data: {
                    '_token': '{{csrf_token() }}',
                    'id': {{Auth::user()->id}}
                }
            }).done((response) => {
                $("#variable").html(response)
                $("#modal-profile").modal('show')
            });
        }
</script>
</body>
</html>



