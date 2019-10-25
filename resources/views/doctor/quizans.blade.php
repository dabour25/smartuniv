@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Answers</li>
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
            @foreach($ans as $k=>$a)
                    <label>Question {{$k+1}}</label>
                    <p>Q:{{$a->question}}</p>
                    <p style="margin-left: 50px;">{{$a->answer}}</p>
            @endforeach
                </div>
                <br><br>
                <a href="/doctor/quiz/{{$qid}}" class="btn btn-success">Back</a>
        </div>
    </div>
    @stop