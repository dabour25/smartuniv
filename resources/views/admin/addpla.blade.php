@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add New Place</li>
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
          <form action="/admin/addpla" method="post">
            @csrf
              <div class="dropdown">
                <label for="form">Choose Type</label>
                <br>
                <select name="type" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="1">Lecture</option>
                    <option value="2">Section</option>
                    <option value="3">Lab</option>
                    <option value="4">Hall</option>
                </select>
              </div>
              <br>
              <div class="form-name">
                  <label for="placename">Name</label>
                  <input type="text" class="form-control" id="placename" name="name">
              </div>
              <div class="form-capacity">
                  <label for="placecapacity">Capacity</label>
                  <input type="text" class="form-control" id="placecapacity" name="capacity">
              </div>
              <div class="form-capacity">
                  <label for="placecapacity">Exam Capacity</label>
                  <input type="text" class="form-control" id="placecapacity" name="examcapacity">
              </div>
              <br>
              <button type="submit" class="btn btn-success">Add New</button>
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