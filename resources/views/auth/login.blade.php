<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form class="form" action="/login" method="post">
        @csrf
        <label> Email: </label>
        <input type="text" name="email" class="form-control" style="width: 50%;">
        <br>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" style="width: 50%;">
        <br>
        <input type="submit" value="Login" class="btn btn-success">
        <br>
        <br>
        <a href="/">
            Back to Home
        </a>
    </form>
</body>