@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registeration</li>
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
    <!-- Page Content -->
        <div class="container">
          <div class="card-body">
          <div class="col-sm-12">
            <div class="box" style="margin-top: 0;">
              <div class="box1">
                <p class="p1">
                  REGISTRAION ? Get Starated Now!
                </p>
                <hr style="width: 100px;">
              </div>
              <form action="/admin/stureg" method="post"> 
              @csrf            
                <input class="control" type="text" placeholder="Write Student Email" name="email">
                <button type="submit" class="btn nbtn btn-dark">
                  <i class="fas fa-lock-open"></i>
                  Get Student</button>
              </form>
            </div>
          </div>
        </div>
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