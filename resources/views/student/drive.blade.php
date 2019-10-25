@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Drive</li>
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
                              <th scope="col">title</th>
                              <th scope="col">Category</th>
                              <th scope="col">Course</th>
                              <th scope="col">Link</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; ?>
                            @foreach($courses as $c)
                            @foreach($drive[$c->id] as $d)
                            <tr>
                              <th scope="row">{{$i}}</th>
                              <td>{{$d->title}}</td>
                              <td>
                                  <?php
                                  if($d->type==0){
                                    echo('Lectures');
                                  }elseif($d->type==1){
                                    echo('Sections');
                                  }elseif($d->type==2){
                                    echo('Cheets');
                                  }else{
                                    echo('Books & References');
                                  }
                                  ?>
                              </td>
                              <td>{{$c->course_name}}</td>
                              <td><a href="{{asset('/drive').'/'.$d->link}}" target="blank">Download</a></td>
                            </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                    @stop