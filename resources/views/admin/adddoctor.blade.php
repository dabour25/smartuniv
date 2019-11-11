@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add New Doctor</li>
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
            <form action="/admin/adddoctor" method="post">
                @csrf
                <br>
                <div class="form-name">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                    <br>
                    <input type="text" class="form-control" id="name" name="middle_name" placeholder="Middle Name" value="{{old('middle_name')}}">
                    <br>
                    <input type="text" class="form-control" id="name" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                </div>
                <div class="form-number">
                    <label for="placecapacity">Mobile Number</label>
                    <input type="tel" class="form-control" id="number" name="mobile_no" value="{{old('mobile_no')}}">
                </div>
                <div class="form-email">
                    <label for="placecapacity">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                </div>
                <div class="form-password">
                    <label for="placecapacity">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Department</label>
                    <br>     
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="department_id">
                      @foreach($departments as $d)
                        <option value="{{$d->id}}" {{old('department_id')==$d->id?'selected':''}}>{{$d->name}}</option>
                      @endforeach
                    </select>
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