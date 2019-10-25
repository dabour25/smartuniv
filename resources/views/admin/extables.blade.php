@extends('admin/master')
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Set Exam Tables</li>
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
	        	<form action="/admin/addexam/{{isset($lvl)?$lvl:''}}" method="post">
		        		@csrf
		        	<label>Select Level</label>
		        	<select class="form-control" id="lvlsel" name="level">
		        		<option value="">Select</option>
		        		@for($i=0;$i<5;$i++)
		        		<option value="{{$i}}" {{isset($lvl)&&$i==$lvl?'selected':''}}>Level {{$i}}/Year {{$i+1}}</option>
		        		@endfor
		        	</select>
		        	<script type="text/javascript">
		        		$('#lvlsel').change(function() {
		        			if($('#lvlsel').val()==""){
		        				location.href='/admin/extables';
		        			}else{
		        				location.href='/admin/extables/'+$('#lvlsel').val();
		        			}
		        		});
		        	</script>
		            @if(isset($lvl))
		            <hr>
		            <h4>Set Table</h4>
	                    <label for="Periodname"><b>Course</b></label>
	                    <select class="form-control" name="course">
			        		<option value="">Select</option>
			        		@foreach($courses as $c)
			        		<option value="{{$c->id}}">{{$c->course_name}}</option>
			        		@endforeach
			        	</select>
			        	<label for="Periodname"><b>Period</b></label>
	                    <select class="form-control" name="period">
			        		<option value="">Select</option>
			        		@foreach($periods as $p)
			        		<option value="{{$p->id}}">{{$p->name}}</option>
			        		@endforeach
			        	</select>
			        	<label for="Periodname"><b>Place</b></label>
	                    <select class="form-control" name="place">
			        		<option value="">Select</option>
			        		@foreach($places as $p)
			        		<option value="{{$p->id}}">{{$p->name}}</option>
			        		@endforeach
			        	</select>
			        	<label for="Periodname"><b>Date</b></label>
			        	<input type="text" class="form-control" name="date">
			        	<br><br>
	                <button type="submit" class="btn btn-primary">
		                Add course to table
		            </button>
	            </form>
	            <h4>The Table</h4>
	            <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>Course Name</th>
                            <th>Period</th>
                            <th>Place</th>
                            <th>Date</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($table as $t)
                        <tr>
                            <td>{{$t->course_name}}</td>
                            <td>{{$t->pname}}</td>
                            <td>{{$t->plname}}</td>
                            <td>{{$t->day}}</td>
                            <td><a href="/admin/remex/{{$t->id}}" class="btn btn-danger">X</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
	            @endif
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