@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Quiz list</li>
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
            <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Quiz Title</th>
                            <th>Course</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($avquiz as $q)
                        @if($q!=null)
                        <tr>
                            <td><a href="/student/quiz/{{$q->id}}"> {{$q->title}}</a></td>
                            <td>{{$q->course_name}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    @stop