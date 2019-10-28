@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add New Section</li>
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
      <div class="alert alert-{{$a[0]}}" style="width: 50%">
        {{$a[1]}}
      </div>
    @endif
	    <div class="container" style="width:80%">
            @if(!isset($groups))
            <div class="card-body">
                <h4>Select To Get Related Groups</h4>
                <form action="/admin/selsec" method="post">
                @csrf
                <div class="dropdown">
                    <label for="form">Department</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="dep">
                        @foreach($deps as $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown">
                    <label for="form">Academic Year</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="acyear">
                        @foreach($acyears as $v)
                        <option value="{{$v->id}}">{{$v->year}} || {{$v->semister}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown">
                    <label for="form">Level</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="level">
                        @for($i=0;$i<5;$i++)
                        <option value="{{$i}}">Year{{$i+1}} / Level{{$i}}</option>
                        @endfor
                    </select>
                </div>
                  <br>
                  <button type="submit" class="btn btn-success">Execute</button>
                </form>
            </div>
            @else
	        <div class="card-body">
	            <form action="/admin/addsec" method="post">
	          	@csrf
                <div class="dropdown">
                    <label for="form">Group</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="group">
                        @foreach($groups as $v)
                        <option value="{{$v->id}}">{{$v->group_name}}</option>
                        @endforeach
                    </select>
                </div>
	            <div class="form-Department">
	                <label for="group">Section Name:</label>
	                <input type="text" class="form-control" placeholder="example: Sec 1" name="section">
                    <label for="group">Section Capacity:</label>
                    <input type="text" class="form-control" placeholder="example: 30" name="capacity">
	            </div>
	              <br>
	              <button type="submit" class="btn btn-success">Add New</button>
                  <a href="/admin/addsec" class="btn btn-primary">Back to Select</a>
	            </form>
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