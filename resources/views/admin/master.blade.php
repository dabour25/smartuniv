<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart University</title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">

    <!-- Bootstrap core CSS-->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- New Add to Master -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/REG_FORM.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Text Editor Library -->
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

 <style>
  .form-control{
   width:60%;
  }
 </style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="/admin">Smart University </a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#" style="padding-left: 20px;">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="/admin/messages">
            <i class="fas fa-envelope fa-fw"></i>
            @if($messagescount!=0)
            <span class="badge badge-danger">{{$messagescount}}</span>
            @endif
          </a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/">Back to Site</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

     <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
          <li class="nav-item active">
              <a class="nav-link" href="/admin">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span>
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-address-book"></i>
                  <span>students Affairs</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/newdeb">Add Department</a>
                  <a class="dropdown-item" href="/admin/editdeb">Edit Department</a>
                  <a class="dropdown-item" href="/admin/acyear">Add/Edit Years</a>
                  <a class="dropdown-item" href="/admin/addgroup">Add Group</a>
                  <a class="dropdown-item" href="/admin/editgroup">Edit Group</a>
                  <a class="dropdown-item" href="/admin/addsec">Add Section</a>
                  <a class="dropdown-item" href="/admin/editsec">Edit Section</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-users"></i>
                  <span>Users</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/adddoctor">Add Doctor</a>
                  <a class="dropdown-item" href="/admin/editdoctor">Edit Doctor</a>
                  <a class="dropdown-item" href="/admin/addassis">Add Assistant</a>
                  <a class="dropdown-item" href="/admin/editassis">Edit Assistant</a>
                  <a class="dropdown-item" href="/admin/addstudent">Add Student</a>
                  <a class="dropdown-item" href="/admin/editstudent">Edit Student</a>
                  <a class="dropdown-item" href="/admin/admincontrol">Admin Control</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-university"></i>
                  <span>Academic Config</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/newpla">Add Place</a>
                  <a class="dropdown-item" href="/admin/editpla">Edit Place</a>
                  <a class="dropdown-item" href="/admin/periods">Periods</a>
                  <a class="dropdown-item" href="/admin/warnings">Warnings</a>
                  <a class="dropdown-item" href="/admin/sysst">System Status</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-paint-brush"></i>
                  <span>Registeration</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/addcourse">Add Course</a>
                  <a class="dropdown-item" href="/admin/editcourse">Edit Course</a>
                  @if($syssta->state==0)
                  <a class="dropdown-item" href="/admin/stureg">Student Registeration</a>
                  <a class="dropdown-item" href="/admin/edstureg">Edit Registeration</a>
                  @endif
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-percent"></i>
                  <span>Exams</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/experiod">Set Periods</a>
                  <a class="dropdown-item" href="/admin/extables">Set Tables</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/admin/ui" role="button">
                  <i class="fas fa-file-word"></i>
                  <span>System UI</span>
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa fa-database"></i>
                  <span>Reports</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="/admin/reports/courses">Courses</a>
              </div>
          </li>
      </ul>

      @yield('content')

      <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/out">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin.min.js')}}"></script>

  </body>

</html>