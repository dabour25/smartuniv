@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Place</li>
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
            @if(isset($pid))
          <form action="/admin/editpla/{{$place->id}}" method="post">
            @csrf
              <div class="dropdown">
                <label for="form">Choose Type</label>
                <br>
                <select name="type" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="1" {{$place->type==1?'selected':''}}>Lecture</option>
                    <option value="2" {{$place->type==2?'selected':''}}>Section</option>
                    <option value="3" {{$place->type==3?'selected':''}}>Lab</option>
                    <option value="4" {{$place->type==4?'selected':''}}>Hall</option>
                </select>
              </div>
              <br>
              <div class="form-name">
                  <label for="placename">Name</label>
                  <input type="text" class="form-control" id="placename" name="name" value="{{$place->name}}">
              </div>
              <div class="form-capacity">
                  <label for="placecapacity">Capacity</label>
                  <input type="text" class="form-control" id="placecapacity" name="capacity" value="{{$place->capacity}}">
              </div>
              <div class="form-capacity">
                  <label for="placecapacity">Exam Capacity</label>
                  <input type="text" class="form-control" id="placecapacity" name="examcapacity" value="{{$place->exam_capacity}}">
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Edit</button>
              <a href="/admin/editpla" class="btn btn-success">Back To Select</a>
              <a href="/admin/rempla/{{$place->id}}" class="btn btn-danger">Remove Place</a>
            </form>
            @else
            <div class="col-sm-12 col-md-6">
                <div id="dataTable_filter" class="dataTables_filter">
                    <label>Search:</label>
                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" style="display: inline;" id="st">
                    <button class="btn btn-success" id="s">Execute</button>
                </div>
                <script type="text/javascript">
                    $('#s').click(function(){
                        if($('#st').val()==''){
                            location.href='/admin/editpla';
                        }else{
                            location.href='/admin/editpla/search/'+$('#st').val();
                        }
                    });
                </script>
                <br>
            </div>
            <div class="container" >          
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Place Type</th>
                            <th>Capacity</th>
                            <th>Exam Cap</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($places as $n=>$v)
                        <tr>
                            <td>{{$n+1}}</td>
                            <td><a href="/admin/editpla/{{$v->id}}">{{$v->name}}</a></td>
                            <td>
                                @if($v->type==1)
                                Lecture
                                @elseif($v->type==2)
                                Section
                                @elseif($v->type==3)
                                Lab
                                @else
                                Hall
                                @endif
                            </td>
                            <td>{{$v->capacity}}</td>
                            <td>{{$v->exam_capacity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $places->links() }}
            </div>
            @endif
        </div>
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