@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Question</li>
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
                        <!-- Questions Form -->
                        <form action="/doctor/question" method="post">
                            @csrf
                            <br>
                            
                            <p class="p">
                                <i class="fas fa-hand-pointer"></i>
                                Select Cousre :
                            </p>
                            <select class="custom-select custom-select-lg mb-3 sec-2" name="cou" id="cousel">
                                <option value="">Select</option>
                            @foreach($courses as $cou)
                                <option value="{{$cou->id}}">{{$cou->course_name}}</option>
                            @endforeach
                            </select>
                            <br>
                            <label>Question</label>
                            <textarea class="form-control" name="con"></textarea>
                            <label>Answer</label>
                            <textarea class="form-control" name="ans"></textarea>
                            <br>
                            <button style="margin-left: 200px;width: 100px;" type="submit" class="btn btn-success">Add</button>
                            <br>
                        </form>
                    </div>
                    @stop