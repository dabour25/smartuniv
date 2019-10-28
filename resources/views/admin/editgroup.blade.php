@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Group</li>
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
	    <div class="container" style="width:80%">
            @if(isset($group))
	        <div class="card-body">
	            <form action="/admin/editgroup/{{$group->id}}" method="post">
	          	@csrf
	            <div class="form-Department">
	                <label for="group">Group Name:</label>
	                <input type="text" class="form-control" placeholder="example: Group A" name="group" value="{{$group->group_name}}">
	            </div>
                <div class="dropdown">
                    <label for="form">Level/Year</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="level">
                        @for($i=0;$i<5;$i++)
                        <option value="{{$i}}" {{$group->level==$i?'selected':''}}>Year{{$i+1}}/Level{{$i}}</option>
                        @endfor
                    </select>
                </div>

	              <br>
	              <button type="submit" class="btn btn-success">Edit</button>
                  <a href="/admin/editgroup" class="btn btn-primary">Back To Select</a>
                  <a href="/admin/remgrp/{{$group->id}}" class="btn btn-danger">Remove Group</a>
	            </form>
                <br>
                <div class="alert alert-warning">
                    <ul>
                        <li>You Can only Remove Group if it isn't Related with Any Sections</li>
                    </ul>
                </div>
	        </div>
            @else
            <div class="container" >          
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>Level</th>
                            <th>Department</th>
                            <th>Academic Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $n=>$v)
                        <tr>
                            <td>{{$n+1}}</td>
                            <td><a href="/admin/editgroup/{{$v->id}}">{{$v->group_name}}</a></td>
                            <td>
                                @for($i=0;$i<5;$i++)
                                @if($v->level==$i)
                                Year {{$i+1}} / Level {{$i}}
                                @endif
                                @endfor
                            </td>
                            <td>{{$v->dep_name}}</td>
                            <td>{{$v->acyear}} || {{$v->semister}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
	    </div>
    <!-- /.container-fluid -->

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