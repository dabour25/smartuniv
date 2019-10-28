@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">System Status</li>
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
    <!-- Page content -->
    <div class="container" style="width:80%">
        <div class="card-body">
        <form action="/admin/sysst" method="post">
          @csrf
          <label>System Status</label>
          <select class="form-control" name="sysst">
            <option value="0" {{$syssta->state=='0'?'selected':''}}>Open Registeration</option>
            <option value="1" {{$syssta->state=='1'?'selected':''}}>Education Period</option>
            <option value="2" {{$syssta->state=='2'?'selected':''}}>Exams</option>
            <option value="3" {{$syssta->state=='3'?'selected':''}}>Results</option>
            <option value="4" {{$syssta->state=='4'?'selected':''}}>System Off</option>
          </select>
          <label>System Academic Year</label>
          <select class="form-control" name="acyear">
            @foreach($acyears as $v)
            @if($v->id==$syssta->ac_year)
            <option value="{{$v->id}}" selected>{{$v->year}}||{{$v->semister}}</option>
            @else
            <option value="{{$v->id}}">{{$v->year}}||{{$v->semister}}</option>
            @endif
            @endforeach
          </select>
          <h5 style="color: red;">!! Academic Year Change Mean Level up Students and Remove Registeration</h5>
          <button type="submit" class="btn btn-success">Execute</button>
        </form>
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