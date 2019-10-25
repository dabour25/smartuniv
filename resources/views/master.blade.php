<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">

    <title>Smart University | {{$page_name}}</title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="{{asset('css/stylehome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/chat.css')}}" rel="stylesheet" type="text/css">


  </head>

  <body>
    <header style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url({{asset('images/back.jpeg')}});">
        
    <div class="row">
        <div class="logo col-md-4">
        <img src="{{asset('images/logo.png')}}">
        </div>
            
    <ul class="main-nav col-md-8">    
        <li {{$page_name=="HOME"?"class=active":''}}><a href="/"> HOME </a></li>
        <li {{$page_name=="ABOUT"?"class=active":''}}><a href="/about"> ABOUT US </a></li>
        <li {{$page_name=="DEPARTMENTS"?"class=active":''}}><a href="/departments"> DEPARTMENTS </a></li>
        <li {{$page_name=="CONTACT"?"class=active":''}}><a href="/contact"> CONTACT US </a></li>
        @if(!Auth::check())
        <li><a href="/login"> LOGIN </a></li>
        @else
        @if(Auth::user()->role=='admin'||Auth::user()->role=='sadmin')
        <li><a href="/admin">ADMIN DB </a></li>
        @elseif(Auth::user()->role=='student')
        <li><a href="/student">STUDENT</a></li>
        @elseif(Auth::user()->role=='doctor'||Auth::user()->role=='assistant')
        <li><a href="/doctor">DOCTOR DB </a></li>
        @endif
        <li><a href="/out">LOGOUT</a></li>
        @endif
        
    </ul>    
        
    </div>
    <div class="tab">
      <div class="tab_words">
        {{$uidata[0]->data}}
      </div>
    </div>
    
    @yield('content')
    
    </header>
      
  </body>

</html>