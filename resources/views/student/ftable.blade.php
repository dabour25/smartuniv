@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Final Table</li>
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
    <div class="container" style="width:80%">
        <div class="card-body">
            @if($syssta->state==2)
            <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Place</th>
                            <th>Period</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($table as $t)
                        <tr>
                            <td>{{$t->course_name}}</td>
                            <td>{{$t->code}}</td>
                            <td>{{$t->plname}}</td>
                            <td>{{$t->pname}}</td>
                            <td>{{$t->start_time}}</td>
                            <td>{{$t->end_time}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            <h3>Table Available only in Exam period</h3>
            @endif
        </div>
     </div>
@stop