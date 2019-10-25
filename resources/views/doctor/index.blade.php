@extends('doctor/master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>
        <div class="container" style="width:80%">
            <div class="card-body">
                <!-- Doctor Home -->
                        <div class="row">
                            <div class="co-sm-12">
                                <div class="card">

                                    <h4 style="text-align: center">
                                        WELCOME..!
                                    </h4>
                                    <h6 style="font-size: 20px;">
                                        <i class="fas fa-user"></i>
                                        DR/ {{Auth::user()->f_name}} {{Auth::user()->m_name}} </h6>
                                    <div style="display: inline-block" title="Evaluation: {{$docdata->evaluation}}">
                                        @for($i=0;$i<round($docdata->evaluation);$i++)
                                        <span class="fa fa-star checked"></span>
                                        @endfor
                                        @for($i=round($docdata->evaluation);$i<5;$i++)
                                        <span class="fa fa-star"></span>
                                        @endfor
                                    </div>

                                </div>


                                <br>

                                <p class="p">
                                    <i class="fas fa-hand-pointer"></i>
                                    Select Your Cousre :
                                </p>
                                <select class="custom-select custom-select-lg mb-3 sec-2" id="cousel">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $c)
                                    <option value="{{$c->id}}">{{$c->course_name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <br>
                                @foreach($courses as $c)
                                <div id="{{$c->id}}" style="display: none;">
                                    <h6 class="info">
                                            <i class="fas fa-info-circle"></i> COURSE ({{$c->course_name}}) INFO.:</h6>
                                    <div class="p-info" >
                                        <p>
                                            Total Student: {{$stucount[$c->id]}}
                                        </p>
                                        <p>
                                           Number of  Student that Has Withdraw: 0
                                        </p>
                                        <p>
                                            Student Has A Warning: 0

                                        </p>
                                        <p>
                                            The Success Rate: {{$sucrate[$c->id]}}%
                                        </p>
                                        <p>
                                            Number Of Quizs: {{$quizc[$c->id]}}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                                <script type="text/javascript">
                                    $('#cousel').change(function() {
                                        @foreach($courses as $c)
                                        $('#{{$c->id}}').hide();
                                        @endforeach
                                        $('#'+$('#cousel').val()).show();
                                    });
                                </script>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@stop