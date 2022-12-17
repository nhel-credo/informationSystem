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



<div class="panel panel-default">
        <div class="panel-body">

<table class="table " id="grade_table">
				
			<caption>
			<label>{{ $grades[0]->lastname.", ".$grades[0]->firstname }}</label>
			<p>{{ $grades[0]->year_level}}</p>
			<p>{{ $grades[0]->course}}</p>

		</caption>

	<thead class="bg-info">
	<tr>
		<td>Id</td>
		<td>Subjects</td>
		<td>Prelim</td>
		<td>MidTerm</td>
		<td>Semi-Final</td>
		<td>Final</td>
		<td>Action</td>
	</tr>
</thead>
	
		@foreach ($grades as $grade)		

		<tr>
		<form id="grade_form" action="{{ action('GradesController@update_grades',$grade->id) }}" method="post">
			@csrf           			
			<input type="hidden" name="hidden-id" value="{{$grade->id}}">
			<td>{{$grade->id}}</td>
			<td>{{$grade->title}}</td>
			<td><input type="text" size="5"  name="prelim" id="prelim" value="{{$grade->prelim}}"> </td>
			<td><input type="text" size="5"  name="midterm" id="midterm" value="{{$grade->midterm}}"></td>
			<td><input type="text" size="5"  name="semi-final" id="semi-final" value="{{$grade->semi_final}}"></td>
			<td><input type="text" size="5"  name="final" id="final" value="{{$grade->final}}"></td>
			<td>
				{{-- <button type="button" class="btn btn-sm btn-info" id="update" onclick="enable()">update</button> --}}
				<button type="submit"  class="btn btn-sm btn-success" id="save"  data-id="{{$grade->id}}">save</button>

			</td>
		</form>
		</tr>
		@endforeach
	
</table>
</div>
</div>


</body>
</html>



<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">



<script type="text/javascript">


function enable(){
	$("#save").removeAttr('disabled');
}


$('#grade_table').on('click','#fsave',function(){

	var id=$(this).data('id');
	var prelim=$('#prelim').val();
	var midterm=$('#midterm').val();
	var semi=$('#semi').val();
	var final=$('#final').val();

	$('#get-subjects:checked').each(function () {
           arr[i++] = $(this).val();
       });




		alert(form);

		$.ajax({
        type:'post',
        url:'{{route('update_grades')}}',
        datatype:"json",       
        data:{"_token": "{{ csrf_token() }}",id:id,prelim:prelim,midterm:midterm,semi:semi,final:final},
        success:function(data){
          alert("Done" +data);
          console.log(data);
        },
        error:function(data){
         alert('Something went wrong!');
          console.log(data);
        },

       });


	
})





</script>
