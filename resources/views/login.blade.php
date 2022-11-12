
<!DOCTYPE html>
<html>
 <head>
  <title>School Information System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
   .box{
    width:400px;
    margin:0 auto;
    border:1px solid #fff;
    height:auto;
    border-radius: 4px;

   }

  .body-color{
    background: #090922;
  }

  </style>
 </head>
 <body class="body-color">
  <br />
  <div class="container box bg-info align-middle">
   <h3 align="center">Information System Login</h3><br />


   @if(isset(Auth::user()->email))
    <script>window.location="/login/successlogin";</script>
   @endif

<!-- getting error message from controller using session -->
   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif


   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

   <form method="post" action="{{ url('/main/checklogin') }}" autocomplete="off">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Enter User Email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group mb-4">
     <label>Enter Password</label>
     <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group mb-4">
     <input type="submit" name="login" class="btn btn-primary form-control " value="Login" />
    </div>
   </form>
  </div>
 </body>
</html>