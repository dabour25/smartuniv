@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Set Student Results</li>
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
            @if(isset($cid))
            <form action="/doctor/results/{{$cid}}" method="post">
                @csrf
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Student</th>
                            <th>Section</th>
                            <th>Mid - Term Score</th>
                            <th>Annual Score</th>
                            <th>Final (Only Exam period)</th>
                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stucou as $s)
                        <tr>
                            <td>{{$s->f_name}} {{$s->m_name}} {{$s->th_name}}</td>
                            <td>{{$s->section}}</td>
                            <td><input type="text" name="mid[{{$s->id}}]" class="form-control" value="{{$s->mid_term}}"></td>
                            <td><input type="text" name="ann[{{$s->id}}]" class="form-control" value="{{$s->annual_evaluation}}"></td>
                            @if($syssta->state!=2)
                            <td>XX</td>
                            @else
                            <td><input type="text" name="fin[{{$s->id}}]" class="form-control" value="{{$s->final_degree}}"></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">Upgrade</button>
            @else
            <p class="p">
            <i class="fas fa-hand-pointer"></i>
            Select Cousre :
        </p>
        <select class="custom-select custom-select-lg mb-3 sec-2" id="cou">
                <option value="">Select</option>
            @foreach($courses as $cou)
                <option value="{{$cou->id}}">{{$cou->course_name}}</option>
            @endforeach
        </select>
        <script type="text/javascript">
            $('#cou').change(function() {
                location.href='/doctor/results/'+$('#cou').val();
            });
        </script>
        @endif
        </div>
    </div>
    @stop