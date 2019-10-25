@extends('admin/master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit User</li>
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
	<div class="container">
	   <div class="card-body">
            @if(isset($uid))
            <form action="/admin/edituser/{{$user->id}}" method="post">
                @csrf
                <div class="dropdown">
                    <label for="form">Choose Type</label>
                    <br>
                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" name="role">
                        <option value="admin" {{$user->role=='admin'?'selected':''}}>Admin</option>
                        <option value="doctor" {{$user->role=='doctor'?'selected':''}}>Doctor</option>
                        <option value="assistant" {{$user->role=='assistant'?'selected':''}}>Assistant</option>
                        <option value="student" {{$user->role=='student'?'selected':''}}>Student</option>
                    </select>
                </div>
                <br>
                <div class="form-name">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="fname" placeholder="First Name" value="{{$user->f_name}}">
                    <br>
                    <input type="text" class="form-control" id="name" name="mname" placeholder="Middle Name" value="{{$user->m_name}}">
                    <br>
                    <input type="text" class="form-control" id="name" name="thname" placeholder="Third Name" value="{{$user->th_name}}">
                    <br>
                    <input type="text" class="form-control" id="name" name="lname" placeholder="Last Name" value="{{$user->l_name}}">
                </div>
                <div class="form-id">
                    <label for="id">RFID</label>
                    <input type="text" class="form-control" id="id" name="rfid" value="{{$user->rfid}}">
                </div>
                <div class="form-Age">
                    <label for="placecapacity">Birth Date</label>
                    <input type="date" class="form-control" id="Age" name="birthdate" value="{{$user->date_of_birth}}">
                </div>
                <div class="form-number">
                    <label for="placecapacity">Mobile Number</label>
                    <input type="text" class="form-control" id="number" name="mobile" value="{{$user->mobile_no}}">
                </div>
                <div class="form-email">
                    <label for="placecapacity">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                </div>
                <div class="form-password">
                    <label for="placecapacity">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <br>
                <button class="btn btn-primary">Edit User</button>
                <a href="/admin/edituser" class="btn btn-success">Back To Select</a>
            </form>
            @else
            <div class="col-sm-12 col-md-6">
                <div id="dataTable_filter" class="dataTables_filter">
                    <label>Search:</label>
                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" style="display: inline;" id="st">
                    <button class="btn btn-success" id="s">Execute</button>
                </div>
                <script type="text/javascript">
                    $('#s').click(function(){
                        if($('#st').val()==''){
                            location.href='/admin/edituser';
                        }else{
                            location.href='/admin/edituser/search/'+$('#st').val();
                        }
                    });
                </script>
                <br>
            </div>
            <div class="container" >          
                <table class="table table-dark">
                    <thead style="margin-top: 5%">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>RFID</th>
                            <th>Birth Date</th>
                            <th>Mobile</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $n=>$v)
                        <tr>
                            <td>{{$n+1}}</td>
                            <td>
                                <a href="/admin/edituser/{{$v->id}}">
                                    {{$v->f_name}} {{$v->m_name}} {{$v->th_name}} {{$v->l_name}}
                                </a>
                            </td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->rfid}}</td>
                            <td>{{$v->date_of_birth}}</td>
                            <td>{{$v->mobile_no}}</td>
                            <td>{{$v->role}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            @endif
        </div>
	</div>
    <!-- /.container-fluid -->


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