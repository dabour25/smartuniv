@extends('admin/master')
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add New Course</li>
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
		<!-- FORM -->
		<form class="form" action="/admin/addcourse" method="post">
			@csrf
			<div class="form-group">
				<label for="formGroupExampleInput">Name</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="name">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Course_Code</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="code">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Course_Credit</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="credit">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Department</label>
				<br>
				<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="dep">
                    @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                    @endforeach
                </select>
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Level</label>
				<br>
				<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="level">
                    @for($i=0;$i<5;$i++)
                    <option value="{{$i}}">Year{{$i+1}}/Level{{$i}}</option>
                    @endfor
                </select>
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput2">Prerequest</label>
				<br>
				<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" id="prereq">
					<option value="">Select Courses</option>
                    @foreach($cou as $co)
                    <option value="{{$co->id}}">{{$co->course_name}}</option>
                    @endforeach
                </select>
			</div>
			<script type="text/javascript">
				var prereq='';
				$('#prereq').change(function(){
					if($('#prereq').val()!=""){
						@foreach($cou as $co)
						if($('#prereq').val()=="{{$co->id}}"){
							$('#c{{$co->id}}').toggle();
						}
						@endforeach
					}
					prereq='';
					@foreach($cou as $co)
					if($('#c{{$co->id}}').is(":visible")){
						prereq+="{{$co->id}},";
					}
					@endforeach
					$('#pre').val(prereq);
				});
			</script>
			@foreach($cou as $co)
			<p id="c{{$co->id}}" style="display: none;">{{$co->course_name}} | {{$co->code}}</p>
			@endforeach
			<input type="text" name="prereq" value="" id="pre" hidden>
			<hr>
			<div class="form-group">
				<input type="checkbox" name="status"> Course Status<br>
			</div>
			<hr>
			<h4>Course Details</h4>
			<div class="form-group">
				<label for="formGroupExampleInput">Lecture Credits</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="lec">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Section Credits</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="sec">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Lab Credits</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="lab">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Lecture Periods</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="lecp">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Section Periods</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="secp">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Lab Periods</label>
				<input type="text" class="form-control" id="formGroupExampleInput" name="labp">
			</div>
			<button type="submit" class="btn btn-success">Add New</button>
		</form>
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