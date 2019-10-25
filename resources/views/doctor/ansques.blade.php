@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Answer Questions</li>
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
            <!-- Doctor QUEStions -->
            @if(isset($ques))
                <p class="p">
                    <i class="far fa-edit"></i>
                    Student Question:
                </p>
                <div class="card" style="width: 100%;margin-left: 0;">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <p class="q">

                                <strong>
                                    Q:
                                </strong> {{$ques->content}}

                            </p>
                        </h2>
                    </div>
                </div>
                <br>
                <form action="/doctor/ansques/{{$qid}}" method="post">
                    @csrf
                    <textarea class="form-control" style="width: 100%;" placeholder="Answer.." name="ans"></textarea>
                    <br>
                    <button style=" margin-left: 320px; width: 150px;" type="submit" class="btn btn-success">Answer</button>
                </form>
            </div>
            @else
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
        <br>
        

        <!--Collapse -->
        <p class="pp">
            Questions About The Selected Course : </p>

               @foreach($courses as $cou)
        <div class="accordion" id="qu{{$cou->id}}" style="display: none;">
            @foreach($questions[$cou->id] as $q)
            <div class="card" style="width:100%;margin-left: 0;">
                <div class="card-header" id="q{{$q->id}}">
                    <h2 class="mb-0">
                        <a class="btn btn-link bbtn " href="/doctor/ansques/{{$q->id}}">
                            {{$q->content}} || Student :{{$q->f_name}} {{$q->m_name}}</a>
                    </h2>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
        </div>
            <script>
                $('#cousel').change(function() {
                    @foreach($courses as $cou)
                    $('#qu{{$cou->id}}').hide();
                    @endforeach
                    $('#qu'+$('#cousel').val()).show();
                });
            </script>
            @endif
        </div>
    </div>
    @stop