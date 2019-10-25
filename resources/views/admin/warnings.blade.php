@extends('admin/master')
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Warnings</li>
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
	        	<form action="/admin/addwarning" method="post">
	        		@csrf
	              <div class="warning-name" style="margin-left: 15%">
	                  <label for="warningname" ><b>Warning Name</b></label>
	                  <input type="text" class="form-control" name="name" >
	              </div>
	              <br>
	              <div class="form-absences" style="margin-left: 15%">
	                  <label for="absence" ><b>Number of absences</b></label>
	                  <input type="number" class="form-control" name="count" >
	              </div>
	              <br>
	              <div class="warning-withdraw" style="margin-left: 35%">
	              <label class="form-check-label" for="inlineCheckbox-withDraw"><b>WithDraw</b></label>
	              <input type="checkbox" id="Checkbox-withDraw" name="withdraw"> 
	                  </div>
	              <br>
	                <button type="submit" class="btn btn-success" style="background-color: #28a745; width: 30% ; margin-left: 25%">Add</button>
	            </form>
	            @if(isset($wid))
	            <form action="/admin/editwarning/{{$wid}}" method="post">
	        		@csrf
			        	<div class="warning-name" style="margin-left: 15%">
		                  <label for="warningname" ><b>Warning Name</b></label>
		                  <input type="text" class="form-control" name="name" value="{{$wrn->name}}">
		              </div>
		              <br>
		              <div class="form-absences" style="margin-left: 15%">
		                  <label for="absence" ><b>Number of absences</b></label>
		                  <input type="number" class="form-control" name="count" value="{{$wrn->count}}">
		              </div>
		              <br>
		              <div class="warning-withdraw" style="margin-left: 35%">
		              <label class="form-check-label" for="inlineCheckbox-withDraw"><b>WithDraw</b></label>
		              <input type="checkbox" id="Checkbox-withDraw" name="withdraw" {{$wrn->withdraw==1?'checked':''}}> 
		                  </div>
		              <br>
	                <button type="submit" class="btn btn-primary" style=" width: 30% ; margin-left:35%">
		                Edit
		            </button>
		            <a href="/admin/warnings" class="btn btn-danger" style="width: 30% ; margin:10px 35%">
		                Back
		            </a>
	            </form>
	            @endif
                <div style="padding-top: 5% ">
                <table class="table table-dark" >
                    <thead >
                        <tr>
                            <th>Warning</th>
                            <th>Count</th>
                            <th>Withdraw</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($warn as $w)
                        <tr>
                            <td><a href="/admin/editwarning/{{$w->id}}">{{$w->name}}</a></td>
                            <td>{{$w->count}}</td>
                            <td>{{$w->withdraw==1?'YES':'NO'}}</td>
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