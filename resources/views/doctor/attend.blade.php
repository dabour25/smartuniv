@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Attendance</li>
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
                        <table class="table table-dark">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Student Name</th>
                              <th scope="col">Course</th>
                              <th scope="col">date</th>
                              <th scope="col">Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; ?>
                            @foreach($courses as $c)
                            @foreach($abs[$c->id] as $d)
                            <tr>
                              <th scope="row">{{$i}}</th>
                              <td>{{$d->f_name}} {{$d->m_name}} {{$d->th_name}}</td>
                              <td>{{$c->course_name}}</td>
                              <td>{{$d->date}}</td>
                              <td><a href="/doctor/remabs/{{$d->id}}" class="btn btn-danger">X</a></td>
                            </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                @stop