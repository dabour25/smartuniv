@extends('admin/master')
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

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  @if($messagescount!=0)
                  <div class="mr-5">{{$messagescount}} New Messages!</div>
                  @else
                  <div class="mr-5">No New Messages</div>
                  @endif
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/admin/messages">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  @if($unreg!=0)
                  <div class="mr-5">{{$unreg}} Unregisterd Students!</div>
                  @else
                  <div class="mr-5">All Student Registerd</div>
                  @endif
                </div>
                <a class="card-footer text-white clearfix small z-1" href="/admin/stureg">
                  <span class="float-left">Register Student</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  @if($unlinkcd!=0)
                  <div class="mr-5">{{$unlinkcd}} Unlinked courses with doctors!</div>
                  @else
                  <div class="mr-5">All Courses Linked with doctors</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  @if($unlinkca!=0)
                  <div class="mr-5">{{$unlinkca}} Unlinked courses with Assistants!</div>
                  @else
                  <div class="mr-5">All Courses Linked with Assistants</div>
                  @endif
                </div>
              </div>
            </div>
          </div>
@stop