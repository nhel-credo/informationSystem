<!DOCTYPE html>
<html>
<head>
  <title>School Information System</title>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>





  @include('dashboardlayout')

  <style type="text/css">
  .title{
    color:#ebebeb;
    font-size: 16px;
    padding:14px;
  }
</style>

</head>


<body class="home">
  <div class="container-fluid display-table">
    <div class="row display-table-row">
      <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
        <div class="logo">
         <label class="title"> School Information System</label>
       </div>
       <div class="navi">
        <ul>
          <li class="active"><a href="{{ url('/main/homepage') }}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
          <li><a href="{{ url('/main/dashboard') }}"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></li>
          <li><a href="{{ url('/main/students') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Students</span></a></li>
          <li><a href="{{ url('/main/teachers') }}"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Teachers</span></a></li>
           <li><a href="{{ url('/main/gradings') }}"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gradings</span></a></li>
          <li><a href="{{ url('/main/subjects') }}"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Subjects</span></a></li>
          <li><a href="{{ url('/main/users') }}"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Users</span></a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-10 col-sm-11 display-table-cell v-align">
      <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
      <div class="row">
        <header>
          <div class="col-md-7">
            <nav class="navbar-default pull-left">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
            </nav>

          </div>

          <div class="col-md-5">            
            <div class="header-rightside">
              <ul class="list-inline header-top pull-right">
              
                

                <li>
                  <a href="#" class="icon-info">
                    <i class="fa fa-user " aria-hidden="true"></i>

                    {{-- getting user info --}}

                    @if(isset(Auth::user()->email))

                    <label>{{ Auth::user()->name }}</label> 
                    @endif

                  </a>
                </li>

                {{-- DROP DOWN START --}}

                <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="navbar-content">

                         @if(isset(Auth::user()->email))

                         <span>{{Auth::user()->name}}</span>
                         <p class="text-muted small">
                          {{Auth::user()->email}}
                        </p>
                        <div class="divider">
                        </div>
                        <a href="{{ url('/main/logout') }}" class="view btn-sm active">Logout</a>

                        @endif

                      </div>
                    </li>
                  </ul>
                </li>

                {{-- END DROP DOWN --}}

              </ul>
            </div>
          </div>
        </header>
      </div>



      {{-- pages start --}}
       
      <div class="panel panel-default">
        <div class="panel-body">
       
       <table class="table table-striped table-hover " id="student_table">

         <caption style="text-align: center;font-size:2rem;">List of All Teachers</caption>
          <caption>
            <a href="#" class="btn btn-md btn-info" data-toggle="" id="add_student_btn" data-target="">New Teacher</a>
          </caption>
        <thead class="bg-info">

          <tr>
            <td>ID</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Birthdate</td>
            <td>Gender</td>
            
            <td class="text-center">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($teacher as $teachers)
          <tr>
            <td>{{$teachers->id}}</td>
            <td>{{$teachers->firstname}}</td>
            <td>{{$teachers->lastname}}</td>
            <td>{{$teachers->email}}</td>
            <td>{{$teachers->phone}}</td>
            <td>{{$teachers->address}}</td>
            <td>{{$teachers->birthdate}}</td>
            <td>{{$teachers->gender}}</td>
            
            <td class="text-center text-nowrap">

              <button class="btn  btn-info btn-sm update-student" data-toggle="tooltip" title="edit" data-target="" 
              data-id="{{$teachers->id}}" 
              data-fname="{{$teachers->firstname}}"
              data-lname="{{$teachers->lastname}}"
              data-email="{{$teachers->email}}"
              data-phone="{{$teachers->phone}}"
              data-address="{{$teachers->address}}"
              data-bdate="{{$teachers->birthdate}}"
              data-gender="{{$teachers->gender}}"
          
              id="update-student"><span class="fa fa-edit"></span></button>

              <form action="{{action('teacherController@destroy',$teachers->id)}}" method="post" style="display: inline-block">
                @csrf

                <button class="btn btn-danger btn-sm" type="submit"><span class="fa fa-trash"></span></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
      </div>


    {{--       pages end --}}

  </div>
</div>

</div>


{{-- adding student modal form --}}
<!-- Modal -->

<div id="add_student" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action = "{{ action('teacherController@insert_teacher') }}" method = "post">

      {{ csrf_field() }}

      <div class="modal-content">
        <div class="modal-header login-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Add New Teacher</h4>
        </div>
        <div class="modal-body">



          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="Firstname">First name</label>
              <input type="text" class="form-control is-valid"  placeholder="First name" name="firstname" required>      
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastname">Last name</label>
              <input type="text"class="form-control is-valid" id="Lastname" placeholder="Last name" name="lastname"  required>      
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="address">Address</label>
              <input type="text" class="form-control is-valid" id="Address" placeholder="Address" name="address"  required>      
            </div>   
          </div>
          <div class="form-row">
            <div class="col-md-6">
              <label for="gender">Gender</label>
              <select id="gender" name="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>     
            </div>  
            <div class="col-md-6">
              <label for="birthdate">Birthdate</label>
              <input type="date" class="form-control is-valid" id="birthdate" placeholder="birthdate"  required name="birthdate">      
            </div> 
          </div>
          <div class="form-row">
            <div class="col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control is-valid" id="email" placeholder="email" name="email"  required>      
            </div>
            <div class="col-md-6">
              <label for="phone">Phone</label>
              <input type="text" class="form-control is-valid" id="phone" placeholder="+63" name="phone"  required>      
            </div>
          </div>
          
         <div class="form-row">
          <div class="col-md-12">
           <label for="course"> </label>
           
         </div>     
       </div> 



         <div class="modal-footer">


          <button type="button" class="cancel" data-dismiss="modal">Close</button>
          <button type="submit" class="add-project" >Save</button>
        </div>

      </div>



    </div>
  </form>

</div>
</div>




{{-- Updating Student Modal--}}
{{-- start --}}
<div id="update_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action = "{{ action('teacherController@update') }}" method = "post">

     {{ csrf_field() }}


     <div class="modal-content">
      <div class="modal-header login-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Update Teacher Info</h4>
      </div>
      <div class="modal-body">


        {{-- hidden id --}}
        <input type="hidden" id="hidden-id" name="update-id">

        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="Firstname">First name</label>
            <input type="text" class="form-control is-valid" id="update-fname" placeholder="First name" name="firstname" required value="">      
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastname">Last name</label>
            <input type="text"class="form-control is-valid" id="update-lname" placeholder="Last name" name="lastname"  required>      
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <label for="address">Address</label>
            <input type="text" class="form-control is-valid" id="update-address" placeholder="Address" name="address"  required>      
          </div>   
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label for="gender">Gender</label>
            <select id="update-gender" name="gender" class="form-control">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>     
          </div>  
          <div class="col-md-6">
            <label for="birthdate">Birthdate</label>
            <input type="date" class="form-control is-valid" id="update-bdate" placeholder="birthdate"  required name="birthdate">      
          </div> 
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control is-valid" id="update-email" placeholder="email" name="email"  required>      
          </div>
          <div class="col-md-6">
            <label for="phone">Phone</label>
            <input type="text" class="form-control is-valid" id="update-phone" placeholder="+63" name="phone"  required>      
          </div>
        </div>
        
        

        <div class="form-row">
          <div class="col-md-12">
           <label for="course"> </label>
           
         </div>     
       </div>       <div class="modal-footer">
        <button type="button" class="cancel" data-dismiss="modal">Close</button>
        <button type="submit" class="add-project" >Save</button>
      </div>
    </div>
  </form>

</div>
</div>

{{-- End --}}


</body>
</html>



<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">



<script type="text/javascript">


$('#student_table').dataTable();

 $('#student_table').on('click','#update-student',function(){

  var id=$(this).data('id');
  var fname=$(this).data('fname');
  var lname=$(this).data('lname');
  var gender=$(this).data('gender');
  var email=$(this).data('email');
  var bdate=$(this).data('bdate');
  var address=$(this).data('address');
  var phone=$(this).data('phone');
  var yearlevel=$(this).data('year_level');
  var course=$(this).data('course');

//alert(fname+lname+gender+email+bdate+address+phone+yearlevel+course);

$('#hidden-id').val(id);
$('#update-fname').val(fname); 
$('#update-lname').val(lname); 
$('#update-address').val(address); 
$('#update-phone').val(phone);
$('#update-gender').val(gender); 
$('#update-email').val(email);  
$('#update-bdate').val(bdate); 

$('#update_modal').modal('show');


});

 $('body').on('click','#add_student_btn',function(){
  $('#add_student').modal('show');

  
});








</script>
