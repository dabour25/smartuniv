@extends('student/master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
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
        <div class="container" style="width:80%">
            <div class="card-body" style="background-color: #343a40;color: #cecece;">
                <div class="cities">
                     <b>
                        <span>
                           Student Name   : {{$studata->f_name}} {{$studata->m_name}} {{$studata->th_name}} <br>
                           Student RFID   : {{$studata->rfid}}<br>
                           Department     : {{$studata->dep_name}}<br>
                           GPA            : {{$studata->GPA}}<br>
                           CGPA           : {{$studata->CGPA}}<br>
                           Level/Year     : Level {{$studata->level}} / Year {{$studata->level+1}}<br>
                           Done Hours     : {{$studata->done_hrs}}<br>
                           Remaining Hours: {{$studata->rem_hrs}}
                        </span>
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
@stop