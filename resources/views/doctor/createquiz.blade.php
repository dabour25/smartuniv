@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Create New Quiz</li>
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
            <form action="/doctor/createquiz" method="post">
                @csrf
                <label>Quiz Title</label>
                <input type="text" class="form-control" name="title">
                <label>Course</label>
                <br>
                <select class="custom-select custom-select-lg mb-3 sec-2" name="course">
                    <option value="">Select Course</option>
                    @foreach($courses as $c)
                    <option value="{{$c->id}}">{{$c->course_name}}</option>
                    @endforeach
                </select>
                <hr>
                <div id="qusarea">
                    <label>Question 1</label>
                    <input type="text" class="form-control" name="question[]">
                </div>
                <br><br>
                <a class="btn btn-success" id="addq" title="add Question">+</a>
                <br><br>
              <button class="btn btn-primary" type="submit" style="width: 150px">Create</button>
            </form>
            <script type="text/javascript">
                var quesc=2;
                $('#addq').click(function() {
                    $('#qusarea').append("<label>Question "+quesc+"</label>"); 
                    $('#qusarea').append("<input type='text' class=\"form-control\" name=\"question[]\">");
                    quesc++;
                });
            </script>
        </div>
    </div>
    @stop