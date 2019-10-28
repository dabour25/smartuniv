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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <header style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url({{asset('images/back.jpeg')}});">
        
    <div class="row">
        <div class="logo col-md-4">
        <a href="/"><img src="{{asset('images/logo.png')}}"></a>
        </div>
            
    <ul class="main-nav col-md-8">    
        <li {{$page_name=="HOME"?"class=active":''}}><a href="/"> HOME </a></li>
        <li {{$page_name=="ABOUT"?"class=active":''}}><a href="/about"> ABOUT US </a></li>
        <li {{$page_name=="DEPARTMENTS"?"class=active":''}}><a href="/departments"> DEPARTMENTS </a></li>
        <li {{$page_name=="CONTACT"?"class=active":''}}><a href="/contact"> CONTACT US </a></li>
        <li style="cursor: pointer;">
            <div class="dropdown">
              <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                PROFILE <i class="fa fa-angle-double-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if(!Auth::guard('admin')->check()&&!Auth::guard('student')->check()&&!Auth::guard('assistant')->check()&&!Auth::guard('doctor')->check())
                <a class="submenu" href="/login/student">Student</a>
                <a class="submenu" href="/login/assistant">Assistant</a>
                <a class="submenu" href="/login/doctor">Doctor</a>
                @else
                @if(Auth::guard('admin'))
                <a class="submenu" href="/admin">Admin db</a>
                @elseif(Auth::guard('student'))
                <a class="submenu" href="/student">Student db</a>
                @elseif(Auth::guard('assistant'))
                <a class="submenu" href="/doctor">Doctor db</a>
                @elseif(Auth::guard('assistant'))
                <a class="submenu" href="/doctor">Assistant db</a>
                @endif
                <a class="submenu" href="/out">Logout</a>
                @endif
              </div>
            </div>
        </li>
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