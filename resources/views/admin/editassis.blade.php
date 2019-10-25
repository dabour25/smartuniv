@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        @if(isset($assis))
        <li class="breadcrumb-item active">Edit Assistant : {{$assis->f_name}} {{$assis->m_name}}</li>
        @else
        <li class="breadcrumb-item active">Edit Assistant</li>
        @endif
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
            @if(isset($assis))
        <form class="form" action="/admin/editassis/{{$assis->aid}}" method="post">
            @csrf
    
          <div class="form-group">
            <label for="formGroupExampleInput">Department</label>
            <br>
                    
            <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="dep">
              @foreach($deps as $d)
                <option value="{{$d->id}}" {{isset($assis->department)&&$assis->department==$d->id?'selected':''}}>{{$d->dep_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Courses</label>
            <br>
            <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" id="prereq">
              <option value="">Select Courses</option>
                @foreach($courses as $c)
                    <option value="{{$c->id}}">{{$c->course_name}}</option>
                @endforeach
              </select>
          </div>
          <script type="text/javascript">
            var prereq='';
            $('#prereq').change(function(){
              if($('#prereq').val()!=""){
                @foreach($courses as $co)
                if($('#prereq').val()=="{{$co->id}}"){
                  $('#c{{$co->id}}').toggle();
                }
                @endforeach
              }
              prereq='';
              @foreach($courses as $co)
              if($('#c{{$co->id}}').is(":visible")){
                prereq+="{{$co->id}}|";
              }
              @endforeach
              $('#pre').val(prereq);
            });
          </script>
          @foreach($courses as $co)
          <?php 
            $show=false; 
            if(isset($assis->courses)){
              $pre = explode("|", $assis->courses);
            }else{
              $pre=[];
            }
          ?>
          @foreach($pre as $p)
          <?php if($p==$co->id){$show=true;} ?>
          @endforeach
          <p id="c{{$co->id}}" 
            @if(!$show)
            style="display: none;"
            @endif
          >{{$co->course_name}} | {{$co->code}}</p>
          @endforeach
          <input type="text" name="courses" value="
          @foreach($pre as $p)
          {{$p}}|
          @endforeach
          " id="pre" hidden>
            
          <button type="submit" class="btn btn-primary">Edit Assistant</button>
          <a href="/admin/editassis" class="btn btn-success">Back To Select</a>
        </form>
    @else
    <!-- Edit Table -->
    <div class="form-inline">
        <h6>
          Search :
        </h6>
        <br><br>
        <input style="width: 300px; margin:0 10px;" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="dr">
        <button class=" edit btn btn-outline-success my-2 my-sm-0" id="s">Search</button>
    </div>
      <script type="text/javascript">
            $('#s').click(function(){
                if($('#dr').val()==''){
                    location.href='/admin/editassis';
                }else{
                    location.href='/admin/editassis/search/'+$('#dr').val();
                }
            });
        </script>
      <br>
      <div class="container">
        <div class="container">
          <table class="table table-dark">

            <thead style="margin-top: 5%">

              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Department</th>
                <th>Evaluation</th>
              </tr>

            </thead>
            <tbody>
                @foreach($assi as $k=>$d)
              <tr>
                <th>{{$k+1}}</th>
                <td>
                    <a href="/admin/editassis/{{$d->aid}}"> {{$d->f_name}} {{$d->m_name}} </a>
                </td>
                <td> {{isset($d->department)?$d->dep_name:'Not Registered'}} </td>
                <td>{{isset($d->evaluation)?$d->evaluation:'5'}} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $assi->links() }}
        </div>
      </div>
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
@stop