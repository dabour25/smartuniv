@extends('student/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/student">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Evaluation</li>
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
            @if($syssta->state==2)
            <style type="text/css">
                .checked{
                    color: orange;
                }
                .fa-star{
                    cursor: pointer;
                }
            </style>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>
                            <p style="color:red;"> Doctor's Name</p>
                        </th>
                        <th><p style="color:red;">Doctor's Evaluation</p></th>

                        <th>
                            <p style="color:red;">Assistan's Name</p>
                        </th>
                        <th><p style="color:red;">Assistant's Evaluation</p></th>

                        <th><p style="color:red;">Course's Name</p></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stucou as $k=>$s)
                    <tr>
                        @if(isset($doc[$s->course_name]))
                        <td><b>DR</b>/{{$doc[$s->course_name]->f_name}} {{$doc[$s->course_name]->m_name}}</td>
                        <td>
                            <div id="ev{{$s->id}}">
                                @for($i=0;$i<5;$i++)
                                <span class="fa fa-star checked" id="ev{{$s->id}}star{{$i}}"></span>
                                @endfor
                            </div>
                        </td>
                        @else
                        <td>N/A</td>
                        <td>N/A</td>
                        @endif
                        @if(isset($inst[$s->course_name]))
                        <td>{{$inst[$s->course_name]->f_name}} {{$inst[$s->course_name]->m_name}}</td>
                        <td>
                            <div id="evs{{$s->id}}">
                                @for($i=0;$i<5;$i++)
                                <span class="fa fa-star checked" id="evs{{$s->id}}star{{$i}}"></span>
                                @endfor
                            </div>
                        </td>
                        @else
                        <td>N/A</td>
                        <td>N/A</td>
                        @endif
                        <td>{{$s->course_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <script type="text/javascript">
                var starsc;
                @foreach($stucou as $k=>$s)
                    @for($i=0;$i<5;$i++)
                    $('#ev{{$s->id}}star{{$i}}').click(function() {
                        starsc={{$i}};
                        for(var v=0;v<=starsc;v++){
                            $('#ev{{$s->id}}star'+v).addClass('checked');
                        }
                        for(var v=starsc+1;v<5;v++){
                            $('#ev{{$s->id}}star'+v).removeClass('checked');
                        }
                        $('#evad{{$s->id}}').val((starsc+1));
                    });
                    $('#evs{{$s->id}}star{{$i}}').click(function() {
                        starsc={{$i}};
                        for(var v=0;v<=starsc;v++){
                            $('#evs{{$s->id}}star'+v).addClass('checked');
                        }
                        for(var v=starsc+1;v<5;v++){
                            $('#evs{{$s->id}}star'+v).removeClass('checked');
                        }
                        $('#evas{{$s->id}}').val((starsc+1));
                    });
                    @endfor
                @endforeach
            </script>
            <form action="/student/evaluate" method="post">
                @csrf
                @foreach($stucou as $k=>$s)
                @if(isset($doc[$s->course_name]))
                <input type="text" name="evd[{{$doc[$s->course_name]->id}}]" id="evad{{$s->id}}" value="5" hidden>
                @endif
                @if(isset($inst[$s->course_name]))
                <input type="text" name="evas[{{$inst[$s->course_name]->id}}]" id="evas{{$s->id}}" value="5" hidden>
                @endif
                @endforeach
                <button type="submit" class="btn btn-success">Send</button>
            </form>
            @else
            <h3>Evaluation Available only in Exam period</h3>
            @endif
        </div>
     </div>
@stop