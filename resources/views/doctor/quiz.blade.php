@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Quiz</li>
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
            @if(isset($qid))
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Student Answerd Quiz</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ansstu as $s)
                        <tr>
                            <td>
                                <a href="/doctor/quiz/{{$qid}}/{{$s->id}}"> 
                                    {{$s->f_name}} {{$s->m_name}} {{$s->th_name}}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/doctor/quiz" class="btn btn-success">Back</a>
        @else
            <a href="/doctor/createquiz" class="btn btn-success">Create New Quiz</a>
            <br><br>
            <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Quiz Title</th>
                            <th>State</th>                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($oldquiz as $q)
                        <tr>
                            <td><a href="/doctor/quiz/{{$q->id}}"> {{$q->title}}</a></td>
                            <td><a href="/doctor/quiztog/{{$q->id}}"> {{$q->state==1?'online':'offline'}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
        </div>
    </div>
    @stop