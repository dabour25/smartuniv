<!DOCTYPE html>
<html>

<head>
    <title>{{isset($url)?$url:''}} login | Smart University</title>
	<link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="body">
    <div style="clear: both">
    </div>
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
    <form class="form" action="/login/{{isset($url)?$url:''}}" method="post">
        @csrf
        <label> Email: </label>
        <input type="text" name="email" class="form-control">
        <br>
        <label>Password:</label>
        <input type="password" name="password" class="form-control">
        <br>
        <input type="submit" value="Login" class="btn btn-success">
        <a href="/" style="margin-left: 45%;">
            Back
        </a>
        <br>
        <br>
    </form>
</body>