@extends('admin/master')
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit Course</li>
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
	        	@if(!isset($couid))
				<table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Course Code</th>
                             <th>Course Credit</th>
                            <th>Department</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($cou as $k=>$c)
                    	<tr>
                            <td>{{$k+1}}</td>
                            <td><a href="/admin/editcourse/{{$c->id}}">{{$c->course_name}}</a></td>
                            <td>{{$c->code}}</td>
                            <td>{{$c->credit}}</td>
                            <td>{{$c->dep_name}}</td>
                            <td>{{$c->level}}</td>
                        </tr>
                        @endforeach
                    </tbody>                          
                </table>
                @else
                <!-- FORM -->
				<form class="form" action="/admin/editcourse/{{$couid}}" method="post">
					@csrf
					<div class="form-group">
						<label for="formGroupExampleInput">Name</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="name" value="{{$cou->course_name}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Course_Code</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="code" value="{{$cou->code}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Course_Credit</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="credit" value="{{$cou->credit}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Department</label>
						<br>
						<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="dep">
		                    @foreach($deps as $dep)
		                    <option value="{{$dep->id}}" {{$dep->id==$cou->dep_id?'selected':''}}>{{$dep->dep_name}}</option>
		                    @endforeach
		                </select>
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Level</label>
						<br>
						<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="level">
		                    @for($i=0;$i<5;$i++)
		                    <option value="{{$i}}" {{$i==$cou->level?'selected':''}}>Year{{$i+1}}/Level{{$i}}</option>
		                    @endfor
		                </select>
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">Prerequest</label>
						<br>
						<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" id="prereq">
							<option value="">Select Courses</option>
		                    @foreach($cours as $co)
		                    <option value="{{$co->id}}">{{$co->course_name}}</option>
		                    @endforeach
		                </select>
					</div>
					<script type="text/javascript">
						var prereq='';
						$('#prereq').change(function(){
							if($('#prereq').val()!=""){
								@foreach($cours as $co)
								if($('#prereq').val()=="{{$co->id}}"){
									$('#c{{$co->id}}').toggle();
								}
								@endforeach
							}
							prereq='';
							@foreach($cours as $co)
							if($('#c{{$co->id}}').is(":visible")){
								prereq+="{{$co->id}},";
							}
							@endforeach
							$('#pre').val(prereq);
						});
					</script>
					@foreach($cours as $co)
					<?php $show=false; ?>
					@foreach($pre as $p)
					<?php if($p->prereq==$co->id){$show=true;} ?>
					@endforeach
					<p id="c{{$co->id}}" 
						@if(!$show)
						style="display: none;"
						@endif
					>{{$co->course_name}} | {{$co->code}}</p>
					@endforeach
					<input type="text" name="prereq" value="
					@foreach($pre as $p)
					{{$p->prereq}},
					@endforeach
					" id="pre" hidden>
					<hr>
					<div class="form-group">
						<input type="checkbox" name="status" {{$cou->state==1?'checked':''}}> Course Status<br>
					</div>
					<hr>
					<h4>Course Details</h4>
					<div class="form-group">
						<label for="formGroupExampleInput">Lecture Credits</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="lec" value="{{$cou->lec}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Section Credits</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="sec" value="{{$cou->sec}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Lab Credits</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="lab" value="{{$cou->lab}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Lecture Periods</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="lecp" value="{{$cou->lec_periods}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Section Periods</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="secp" value="{{$cou->sec_periods}}">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput">Lab Periods</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="labp" value="{{$cou->lab_periods}}">
					</div>
					<button type="submit" class="btn btn-primary">Edit</button>
					<a href="/admin/editcourse" class="btn btn-danger">Back</a>
				</form>
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