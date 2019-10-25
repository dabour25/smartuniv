@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Questions</li>
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
                        <form action="/student/question" method="post">
                            @csrf
                            <br>
                            
                            <p class="p">
                                <i class="fas fa-hand-pointer"></i>
                                Select Cousre :
                            </p>
                            <select class="custom-select custom-select-lg mb-3 sec-2" name="cou" id="cousel">
                                <option value="">Select</option>
                            @foreach($course as $cou)
                                <option value="{{$cou->id}}">{{$cou->course_name}}</option>
                            @endforeach
                            </select>
                            <br>
                            <label>Your Question</label>
                            <textarea class="form-control" name="con"></textarea>
                            <br>
                            <button style="margin-left: 200px;width: 100px;" type="submit" class="btn btn-success">Add</button>
                            <br>
                        </form>

                        <!--Collapse -->

                        <p class="pp">
                            Previous Questions & Answers About The Selected Course : </p>
                            @foreach($course as $cou)
                        <div class="accordion" id="qu{{$cou->id}}" style="display: none;">
                            @foreach($ques as $q)
                            @if($q->course_id==$cou->id)
                            <div class="card">
                                <div class="card-header" id="q{{$q->id}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link bbtn " type="button" data-toggle="collapse" data-target="#c{{$q->id}}" aria-expanded="true" aria-controls="c{{$q->id}}">
                                            {{$q->content}} </button>
                                    </h2>
                                </div>

                                <div id="c{{$q->id}}" class="collapse " aria-labelledby="q{{$q->id}}" data-parent="#q{{$q->id}}">
                                    <div class="card-body">
                                        {{$q->ans}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                        @endforeach
                        @endforeach
                        <script>
                            $('#cousel').change(function() {
                                @foreach($course as $cou)
                                $('#qu{{$cou->id}}').hide();
                                @endforeach
                                $('#qu'+$('#cousel').val()).show();
                            });
                        </script>
                    </div>
                    @stop