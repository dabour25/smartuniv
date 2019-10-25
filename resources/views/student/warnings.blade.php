@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Warnings</li>
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
	          <div class="container" style="width:80%">        
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Number of absences</th>
                            <th>Warning Number</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $v)
                        <tr>
                            <td>{{$v->course_name}}</td>
                            <td>{{$v->code}}</td>
                            <td>{{$abs[$v->cid]}}</td>
                            <td>{{$warn[$v->cid]->name}}</td>
                        </tr>
                      @endforeach
                    </tbody>
            </table>
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