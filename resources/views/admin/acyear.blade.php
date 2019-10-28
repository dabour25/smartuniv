@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add/Edit Academic Years</li>
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
    <!--success message in all views-->
	  <div class="container" style="width:80%">
	      <div class="card-body">
	          <form action="/admin/addac" method="post">
	          	@csrf
	              <div class="form-Department">
	                  <label for="group">Academic Year:</label>
	                  <input type="text" class="form-control" id="Department" placeholder="example: 2018/2019 or 2018S1 etc.." name="acyear">
                    <label for="group">Semister:</label>
                    <input type="text" class="form-control" id="Semister" placeholder="example: 1" name="semister">
                    <input type="checkbox" name="level"> Level Up 
	              </div>
	              <br>
	              <button type="submit" class="btn btn-success">Add</button>
	          </form>
	      </div>
	  </div>
    <!-- /.container-fluid -->
    <hr>
    @foreach($acyears as $v)
    <div class="container" style="width:80%;display: none;" id="f{{$v->id}}">
        <div class="card-body">
            <form action="/admin/editac/{{$v->id}}" method="post">
              @csrf
                <div class="form-Department">
                    <label for="group">Academic Year:</label>
                    <input type="text" class="form-control" placeholder="example: 2018/2019 or 2018S1 etc.." name="acyear" value="{{$v->year}}">
                    <label for="group">Semister:</label>
                    <input type="text" class="form-control" placeholder="example: 1" name="semister" value="{{$v->semister}}">
                    <input type="checkbox" name="level" {{$v->level_up==1?'checked':''}}> Level Up
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
    @endforeach
    <div class="container" style="width:80%">
        <div class="card-body">
          <div class="form-Department">
              <label for="group">Select To Edit:</label>
              <select class="form-control" id="sel">
                <option value="">Academic Year || Semister</option>
                @foreach($acyears as $v)
                <option value="{{$v->id}}">{{$v->year}} || {{$v->semister}}</option>
                @endforeach
              </select>
          </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#sel').change(function(){
            @foreach($acyears as $v)
            if($('#sel').val()=='{{$v->id}}'){
                $('#f{{$v->id}}').show();
            }else{
                $('#f{{$v->id}}').hide();
            }
            @endforeach
        });
    </script>
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