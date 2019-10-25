@extends('admin/master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">System UI</li>
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
        <div class="container">
          <div class="card-body">
            <form action="/admin/editui" method="post" enctype="multipart/form-data">
              @csrf
              <h4>News Tap:</h4>
              <textarea name="tap" class="form-control">{{$data[0]->data}}</textarea>
              <br>
              <a href="/upload/editor" target="blank" class="btn btn-success">Upload image & get link</a>
              <br>
              <h4>About Page</h4>
              <textarea name="about">{{$data[1]->data}}</textarea>
              <h4>Departments Page</h4>
              <textarea name="departments">{{$data[2]->data}}</textarea>
              <br>
              <button type="submit" class="btn btn-primary">Edit</button>
            </form>
          </div>
        </div>
        <script>
            CKEDITOR.replace( 'about' );
            CKEDITOR.replace( 'departments' );
        </script>
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