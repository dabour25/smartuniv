@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Answer The Quiz</li>
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
            <form action="/student/quizans/{{$qid}}" method="post">
                @csrf
                @foreach($ques as $k=>$q)
                    <label>Question {{$k+1}}</label>
                    <p>{{$q->question}}</p>
                    <input type="text" class="form-control" name="ans[{{$q->id}}]">
                @endforeach
                <br><br>
              <button class="btn btn-primary" type="submit">Send Answers</button>
            </form>
        </div>
    </div>
    @stop