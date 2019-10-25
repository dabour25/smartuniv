@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Student</li>
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
            @if(isset($sid))
    <form class="form" action="/admin/editstu/{{$stud->sid}}" method="post">
        @csrf
      <div class="form-group">
        <label for="formGroupExampleInput">Name</label>
        <p>{{$stud->f_name}} {{$stud->m_name}}</p>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput">Level</label>
        <br>
        <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="level">
            @for($i=0;$i<5;$i++)
            <option value="{{$i}}" {{$stud->level==$i?'selected':''}}>Year{{$i+1}}/Level{{$i}}</option>
            @endfor
        </select>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput">Department</label>
        <br>
        <select class="custom-select custom-select-sm form-control form-control-sm" name="dep">
            @foreach($deps as $dep)
            <option value="{{$dep->id}}" {{$stud->department==$dep->id?'selected':''}}>{{$dep->dep_name}}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput">Done Hours</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="done" value="{{$stud->done_hrs}}">
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput">GPA</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="gpa" value="{{$stud->GPA}}">
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput">CGPA</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="cgpa" value="{{$stud->CGPA}}">
      </div>
      <button type="submit" class="btn btn-primary">Edit Student</button>

      <a href="/admin/editstu" class="btn btn-success">Back To Select</a>
    </form>
    @else
    <!-- Edit Table -->
    <div class="form-inline">
        <h6>
          Search :
        </h6>
        <br><br>
        <input style="width: 300px; margin:0 10px;" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="st">
        <button class=" edit btn btn-outline-success my-2 my-sm-0" id="s">Search</button>
    </div>
      <script type="text/javascript">
            $('#s').click(function(){
                if($('#st').val()==''){
                    location.href='/admin/editstu';
                }else{
                    location.href='/admin/editstu/search/'+$('#st').val();
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
                <th>Level</th>
                <th>Department</th>
                <th>Total-Hours</th>
                <th>GPA</th>
                <th>CGPA</th>
              </tr>

            </thead>
            <tbody>
                @foreach($stu as $k=>$st)
              <tr>
                <th>{{$k+1}}</th>
                <td>
                    <a href="/admin/editstu/{{$st->sid}}"> {{$st->f_name}} {{$st->m_name}} </a>
                </td>
                <td>
                    @for($i=0;$i<5;$i++)
                    @if($st->level==$i)
                    Year {{$i+1}} / Level {{$i}}
                    @endif
                    @endfor
                </td>
                <td> {{$st->dep_name}} </td>
                <td>{{$st->done_hrs}} </td>
                <td>{{$st->GPA}}</td>
                <td>{{$st->CGPA}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $stu->links() }}
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