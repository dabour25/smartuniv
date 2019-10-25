@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Table</li>
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
            <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th></th>
                            @foreach($periods as $p)
                            <th>{{$p->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($days as $k=>$d)
                        <tr>
                            <td>{{$d}}</td>
                            @foreach($periods as $p)
                            <?php $sub=$place=$type=''; ?>
                            @foreach($table as $t)
                            @foreach($t as $tt)
                            @if($tt->period_id+1==$p->id&&$tt->day==$k)
                            <?php 
                                $sub=$tt->course_name;
                                if(isset($tt->pname))
                                    $place=$tt->pname; 
                                $type=$tt->type; 
                            ?>
                            @endif
                            @endforeach
                            @endforeach
                            <td>{{$sub}}<br>{{$place}}<br>{{$type}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
     </div>
@stop