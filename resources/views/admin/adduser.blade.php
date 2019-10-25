@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add New User</li>
      </ol>

    <!-- Page Content -->
    @if(count($errors)>0)
    <br>
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('m'))
      <?php $a=[]; $a=session()->pull('m'); ?>
      <div class="alert alert-{{$a[0]}}" style="width: 40%">
        {{$a[1]}}
      </div>
    @endif
	<div class="container" style="width:80%">
	   <div class="card-body">
            <form action="/admin/adduser" method="post">
                @csrf
                <div class="dropdown">
                    <label for="form">Choose Type</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="role">
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="assistant">Assistant</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <br>
                <div class="form-name">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="fname" placeholder="First Name">
                    <br>
                    <input type="text" class="form-control" id="name" name="mname" placeholder="Middle Name">
                    <br>
                    <input type="text" class="form-control" id="name" name="thname" placeholder="Third Name">
                    <br>
                    <input type="text" class="form-control" id="name" name="lname" placeholder="Last Name">
                </div>
                <div class="form-id">
                    <label for="id">RFID</label>
                    <input type="text" class="form-control" id="id" name="rfid">
                </div>
                <div class="form-Age">
                    <label for="placecapacity">Birth Date</label>
                    <input type="date" class="form-control" id="Age" name="birthdate" value="2000-01-01">
                </div>
                <div class="form-number">
                    <label for="placecapacity">Mobile Number</label>
                    <input type="text" class="form-control" id="number" name="mobile">
                </div>
                <div class="form-email">
                    <label for="placecapacity">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-password">
                    <label for="placecapacity">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <br>
                <button class="btn btn-success">Create User</button>
            </form>
        </div>
	</div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Smart University Team 2019</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->

</div>
@stop