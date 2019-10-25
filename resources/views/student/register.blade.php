@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student Registeration</li>
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
      <div class="col-sm-12">
                <div class="table-div">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr style="margin-top: 100px;">
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$stu->f_name}} {{$stu->m_name}}</td>
                                <td>{{$stu->email}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Level</th>

                                <th style="padding-left:250px; " scope="col">Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$stu->level}}</td>
                                <td style="padding-left:245px; ">{{$stu->dep_name}}</td>
                            </tr>


                        </tbody>
                    </table>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Total Passed Hours</th>
                                <th style="padding-right: 65px;" scope="col">GPA</th>
                                <th style="padding-right: 65px;" scope="col">CGPA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: solid 1px gray">
                                <td>{{$stu->done_hrs}}</td>
                                <td>{{$stu->GPA}}</td>
                                <td>{{$stu->CGPA}}</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <form action="/student/register" method="post">
                    @csrf
                <div class="check-box-div">
                    <br>
                    <hr style="width: 200px;" style="color: black">
                    <p class="p">
                        <i class="fas fa-check-circle"></i> Select Courses
                    </p>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">course code</th>
                                <th scope="col">course Credit</th>
                                <th scope="col">Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($couf as $k=>$cof)
                            <tr>
                                <th scope="row">{{$k+1}}</th>
                                <td>
                                     <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$cof->id}}" name="cou[]">
                                        <label class="form-check-label" for="inlineCheckbox1" style="color:red">{{$cof->course_name}}</label>
                                    </div>
                                </td>
                                <td>{{$cof->code}}</td>
                                <td>{{$cof->credit}}</td>
                                <td>
                                    <select class="form-control" name="cousec[{{$cof->id}}]">
                                        @foreach($sec[$cof->id] as $se)
                                        <option value="{{$se->id}}">{{$se->section}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($cou as $k=>$co)
                            <tr>
                                <th scope="row">{{$k+1}}</th>
                                <td>
                                     <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$co->id}}" name="cou[]">
                                        <label class="form-check-label" for="inlineCheckbox1">{{$co->course_name}}</label>
                                    </div>
                                </td>
                                <td>{{$co->code}}</td>
                                <td>{{$co->credit}}</td>
                                <td>
                                    <select class="form-control" name="cousec[{{$co->id}}]">
                                        @foreach($sec[$co->id] as $se)
                                        <option value="{{$se->id}}">{{$se->section}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
                </form>
            </div>
    </div>
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Smart University Team 2019</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->

</div>
@stop