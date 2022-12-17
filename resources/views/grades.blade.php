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

           <caption style="text-align: center;font-size:2rem;">List of Students</caption>
           <caption>
            Grade Inputs
          </caption>
          <thead class="bg-info ">

            <tr>
              <td>ID</td>
              <td>FullName</td>              
              <td>Yr. Level</td>
              <td>Course</td>             
              <td class="text-center">Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($student as $students)
            <tr>
              <td>{{$students->id}}</td>
              <td>{{$students->lastname.', '.$students->firstname}}</td>    
              <td>{{$students->year_level}}</td>
              <td>{{$students->course}}</td>
              
              <td class="text-center text-nowrap">

               <button class="btn  btn-success btn-sm " data-toggle="tooltip" title="view subjects" data-target=""data-id="{{$students->id}}"id="view-subjects"><span class="fa fa-edit"></span>Select Subjects</button> 

                 <form action="{{ action('GradesController@populate_grades_bysubject',$students->id) }}" method="post" style="display: inline-block">

              @csrf

                <button class="btn  btn-info btn-sm " name="id" data-toggle="tooltip" title="view grades" data-target=""data-id="{{$students->id}}"id="view-grades"><span class="fa fa-edit"></span>Grades</button> 

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








<!--Select subjects Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <form id="subjects-form">
        @csrf
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subjects</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="hidden-subject-id" name="hidden-subject-id">
          <table class="table" id="subject-table">
           <caption style="text-align: center;font-size:2rem;">Subjects</caption>
           
            <thead class="bg-info">
              <tr>
                <td>Id</td>
                <td>Subject</td>
                <td>Time</td>
                <td>Schedule</td>
                <td>Select</td>
              </tr>
            </thead>
            <tbody>
              @foreach($subjects as $subj)
              <tr>
                <td>{{$subj->id}}</td>
                <td>{{$subj->title}}</td>
                <td>{{$subj->time}}</td>
                <td>{{$subj->schedule}}</td>
                <td><input type="checkbox" name="selected-subjects" id="get-subjects" value="{{$subj->id}}"></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" id="selected-subjects" >Select</button>    
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
{{-- End --}}

<!--Grades Modal -->
  <div class="modal fade" id="grades" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="submit" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Student Grades</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead class="text-center">
            <tr>
              <td>Subjects</td>
              <td>Prelim</td>
              <td>Midterm</td>
              <td>Semi-Final</td>
              <td>Final</td>
            </tr>
          </thead>
       
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
{{-- End --}}


</body>
</html>



<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">



<script type="text/javascript">

  $(document).ready(function(){

    var table= $('#student_table');



    table.on('click','#update-student',function(e){

e.preventDefault();
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
$('#update-yrlvl').val(yearlevel);  
$('#update-course').val(course); 
$('#update-bdate').val(bdate); 

$('#update_modal').modal('show');


});

  
  table.on('click','#view-subjects',function(){
    var id=$(this).data('id');
    $('#hidden-subject-id').val(id);
    $('#myModal').modal({backdrop:'static'});
  });

//show grades per subjects
//     table.on('click','#view-grades',function(){
//     var id=$(this).data('id');
//     // alert(id);

//     $.ajax({
//       type:'post',
//       url:'{{route('populate_grades')}}',
//       datatype:"json",
//       data:{"_token": "{{ csrf_token() }}",id:id},
//       success:function(data){
//         alert('done');

//       },
//       error:function(data){
//         alert("error"+data);
//       },

//     });
     
    
// });



  });



  $('body').on('click','#add_student_btn',function(e){
e.preventDefault(); 
    $('#add_student').modal('show');

  });


//inserting data from checkbox form
$('#subjects-form').on('submit',function(){


       i=0;
       var arr = [];

       $('#get-subjects:checked').each(function () {
           arr[i++] = $(this).val();
       });

       //alert(id+ arr);
       //alert($('#subjects-form').serialize());

    var id=$('#hidden-subject-id').val();

       $.ajax({
        type:'post',
        url:'{{route('insert_selected')}}',
        datatype:"json",       
        data:{"_token": "{{ csrf_token() }}",id:id,'arr[]':arr},
        success:function(data){
          alert("Done");
          console.log(data);
        },
        error:function(data){
         alert('Something went wrong!');
          console.log(data);
        },

       });
});






</script>
