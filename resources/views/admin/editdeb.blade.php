@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Department</li>
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
    @if(isset($did))
	  <div class="container" style="width:80%">
	      <div class="card-body">
	          <form action="/admin/editdeb" method="post">
	          	@csrf
	              <div class="form-Department">
	                  <label for="group">Department Name</label>
	                  <input type="text" class="form-control" id="Department" placeholder="example: Computer" name="department" value="{{$didata->dep_name}}">
                      <input type="text" name="did" value="{{$did}}" hidden>
	              </div>
	              <br>
	              <button type="submit" class="btn btn-primary">Edit Department</button>
                  <a href="/admin/editdeb" class="btn btn-success">Back To Select</a>
	          </form>
	      </div>
	  </div>
    <!-- /.container-fluid -->
    @else
    <div class="container" >          
        <table class="table table-dark">
            <thead style="margin-top: 5%">
                <tr>
                    <th>#</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deps as $n=>$v)
                <tr>
                    <td>{{$n+1}}</td>
                    <td><a href="/admin/editdeb/{{$v->id}}">{{$v->dep_name}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
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