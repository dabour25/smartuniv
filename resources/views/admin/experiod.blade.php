@extends('admin/master')
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add New Exam Period</li>
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
	        <div class="card-body">
	        	<form action="/admin/addexperiod" method="post">
	        		@csrf
		        	<div class="form-period" style="width: 25%; float: left;  margin-left: 5% ">
	                      <label for="Periodname"><b>Period</b></label>
	                      <input type="text" class="form-control" name="name">
	                  </div>
	                  <div class="form" style="width: 25% ; float: left ; margin-left: 5% ">
	                      <label for="from"><b>From</b></label>
	                      <input type="text" class="form-control" name="from" placeholder="09:00AM">
	                  </div>
	                <div class="to" style="width: 25% ; float: left ; margin-left: 10%;padding-bottom: 5%  ">
	                      <label for="to"><b>To</b></label>
	                      <input type="text" class="form-control" name="to" placeholder="12:00PM">
	                  </div>
	                <button type="submit" class="btn btn-success" style="background-color: #28a745; width: 30% ; margin-left:35%">
		                Add
		            </button>
	            </form>
	            @if(isset($pid))
	            <form action="/admin/editexperiod/{{$pid}}" method="post">
	        		@csrf
		        	<div class="form-period" style="width: 25%; float: left;  margin-left: 5% ">
	                      <label for="Periodname"><b>Period</b></label>
	                      <input type="text" class="form-control" name="name" value="{{$perd->name}}">
	                  </div>
	                  <div class="form" style="width: 25% ; float: left ; margin-left: 5% ">
	                      <label for="from"><b>From</b></label>
	                      <input type="text" class="form-control" name="from" placeholder="09:00AM" value="{{$perd->start_time}}">
	                  </div>
	                <div class="to" style="width: 25% ; float: left ; margin-left: 10%;padding-bottom: 5% ">
	                      <label for="to"><b>To</b></label>
	                      <input type="text" class="form-control" name="to" placeholder="10:30AM" value="{{$perd->end_time}}">
	                  </div>
	                <button type="submit" class="btn btn-primary" style=" width: 30% ; margin-left:35%">
		                Edit
		            </button>
		            <a href="/admin/experiod" class="btn btn-danger" style="width: 30% ; margin:10px 35%">
		                Back
		            </a>
	            </form>
	            @endif
                <div style="padding-top: 5% ">
                <table class="table table-dark" >
                    <thead >
                        <tr>
                            <th>Period</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($experiod as $p)
                        <tr>
                            <td><a href="/admin/editexperiod/{{$p->id}}">{{$p->name}}</a></td>
                            <td>{{$p->start_time}}</td>
                            <td>{{$p->end_time}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
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
</div>
    <!-- /#wrapper -->
@stop