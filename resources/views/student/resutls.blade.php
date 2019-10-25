@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Results</li>
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
	          <div class="container">          
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>NO</th>
                            <th>Course code</th>
                            <th>course Name</th>
                            <th>Mid - Term Score</th>
                            <th>Annual Score</th>
                            @if($syssta->state==3)
                            <th>Grade</th>
                            @endif
                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentcou as $k=>$v)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$v->code}}</td>
                            <td>{{$v->course_name}} </td>
                            <td>{{$v->mid_term}}</td>
                            <td>{{$v->annual_evaluation}}</td>
                            @if($syssta->state==3)
                            @if($v->grade=="F")
                            <td style="color: red;">{{$v->grade}}</td>
                            @else
                            <td style="color: green;">{{$v->grade}}</td>
                            @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </h1>
            </div>
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