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

         <caption style="text-align: center;font-size:2rem;">List of All Subjects</caption>
          <caption>
            <a href="#" class="btn btn-md btn-info" data-toggle="" id="add_student_btn" data-target="">Add Subject</a>
          </caption>
        <thead class="bg-info">

          <tr>
            <td>ID</td>
            <td>Subject</td>
            <td>Description</td>
            <td>Time</td>
            <td>Schedule</td>    
            
            <td class="text-center">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($subjects as $subj)
          <tr>
            <td>{{$subj->id}}</td>
            <td>{{$subj->title}}</td>
            <td>{{$subj->description}}</td>
            <td>{{$subj->time}}</td>
            <td>{{$subj->schedule}}</td>            
            
            <td class="text-center text-nowrap">

              <button class="btn  btn-info btn-sm update-student" data-toggle="tooltip" title="edit" data-target="" 
              data-id="{{$subj->id}}"
              data-subject="{{$subj->title}}"  
              data-description="{{$subj->description}}" 
              data-time="{{$subj->time}}" 
              data-schedule="{{$subj->schedule}}"                  
          
              id="update-student"><span class="fa fa-edit"></span></button>

              <form action="{{ action('SubjectController@destroy',$subj->id) }}" method="post" style="display: inline-block">
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


{{-- adding  modal form --}}
<!-- Modal -->

<div id="add_student" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action = "{{ url('subjects/insert_subject') }}" method = "post">

      {{ csrf_field() }}
        @csrf
      <div class="modal-content">
        <div class="modal-header login-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Add Subject</h4>
        </div>
        <div class="modal-body">



          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="subject">Subject Title</label>
              <input type="text" class="form-control is-valid"  placeholder="Subject" name="subject" required>      
            </div>
            <div class="col-md-6 mb-3">
              <label for="description">Description</label>
              <input type="text"class="form-control is-valid" id="description" placeholder="Subject Description" name="description"  required>      
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="time">Time</label>
              <input type="text" class="form-control is-valid" id="time" placeholder="Time" name="time"  required>      
            </div>   
          </div>          
          <div class="form-row">            
            <div class="col-md-12">
              <label for="phone">Schedule</label>
              <input type="text" class="form-control is-valid" id="schedule" placeholder="Schedule" name="schedule"  required>      
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




{{-- Updating  Modal--}}
{{-- start --}}
<div id="update_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action ="{{ action('SubjectController@update') }}" method = "post">

     {{ csrf_field() }}


     <div class="modal-content">
      <div class="modal-header login-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Updating Subject Record</h4>
      </div>
      <div class="modal-body">


        {{-- hidden id --}}
        <input type="hidden" id="hidden-id" name="update-id">

        <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="subject">Subject Title</label>
              <input type="text" class="form-control is-valid" id="update-subject" placeholder="Subject" name="update-subject" required>      
            </div>
            <div class="col-md-6 mb-3">
              <label for="description">Description</label>
              <input type="text"class="form-control is-valid" id="update-description" placeholder="Subject Description" name="update-description"  required>      
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="time">Time</label>
              <input type="text" class="form-control is-valid" id="update-time" placeholder="Time" name="update-time"  required>      
            </div>   
          </div>          
          <div class="form-row">            
            <div class="col-md-12">
              <label for="phone">Schedule</label>
              <input type="text" class="form-control is-valid" id="update-schedule" placeholder="Schedule" name="update-schedule"  required>      
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
  var subj=$(this).data('subject');
  var desc=$(this).data('description');
  var time=$(this).data('time');
  var schedule=$(this).data('schedule');


// alert(id+subj+desc+time+schedule);

$('#hidden-id').val(id);
$('#update-subject').val(subj);
$('#update-description').val(desc);
$('#update-time').val(time);
$('#update-schedule').val(schedule);


$('#update_modal').modal('show');


});

 $('body').on('click','#add_student_btn',function(){
  $('#add_student').modal('show');

  
});








</script>
