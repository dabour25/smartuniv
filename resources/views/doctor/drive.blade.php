@extends('doctor/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/doctor">Dashboard</a>
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
                        <form action="/doctor/drive" method="post" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <p class="p">
                                <i class="fas fa-hand-pointer"></i>
                                Select Cousre :
                            </p>
                            <select class="custom-select custom-select-lg mb-3 sec-2" name="course">
                                <option value="">Select</option>
                            @foreach($courses as $cou)
                                <option value="{{$cou->id}}">{{$cou->course_name}}</option>
                            @endforeach
                            </select>
                            <br>
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                            <label>type</label>
                            <br>
                            <select class="custom-select custom-select-lg mb-3 sec-2" name="type">
                                <option value="0">Lecture</option>
                                <option value="1">Section</option>
                                <option value="2">Cheets</option>
                                <option value="3">Books & References</option>
                            </select>
                            <br>
                            <label>File (PDF - Max : 8MB)</label>
                            <br>
                            <input type="file" name="file">
                            <br><br>
                            <button style="margin-left: 200px;width: 100px;" type="submit" class="btn btn-success">Add</button>
                            <br>
                        </form>
                        <br>
                        <table class="table table-dark">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">title</th>
                              <th scope="col">Category</th>
                              <th scope="col">Course</th>
                              <th scope="col">Link</th>
                              <th scope="col">Remove</th>
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
                              <td><a href="/doctor/remdrive/{{$d->id}}" class="btn btn-danger">X</a></td>
                            </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                @stop