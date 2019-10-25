@extends('master')
@section('content')
    <h2 class="pagetitle">Contact US</h2>
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
    <form action="/sendmes" method="post">
        @csrf
        <div class="row" style="width: 75%;padding-top: 50px;">
            <div class="col-sm-6">
                <label class="clabel">Name:</label>
                <input type="text" class="form-control" placeholder="Enter Your Name" name="name">
            </div>
            <div class="col-sm-6">
                <label class="clabel">E-Mail:</label>
                <input type="text" class="form-control" placeholder="E-Mail" name="email">
            </div>
            <div class="col-sm-12">
                <label class="clabel">Subject:</label>
                <input type="text" class="form-control" placeholder="How Can we help you ?" name="subject">
            </div>
            <div class="col-sm-12">
                <label class="clabel">Message:</label>
                <textarea type="text" class="form-control" placeholder="Details.." rows="4" name="message"></textarea>
            </div>
            <button class="btn btn-success" type="submit" style="margin: 10px 20px;">Send</button>
        </div>
    </form>
@endsection
