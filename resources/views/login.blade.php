<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>InQ - A Responsive Bootstrap 3 Admin Login</title>
      <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('backend/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
      <link href="{{ asset('backend/css/animate.css')}}" rel="stylesheet">
      <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">
   </head>
   <body class="gray-bg">
      <div class="loginColumns animated fadeInDown">
         <div class="row">
            <div class="col-md-6">
               <h2 class="font-bold">Welcome to QTC</h2>
               <p>
                  Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
               </p>
               <p>
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s.
               </p>
               <p>
                  When an unknown printer took a galley of type and scrambled it to make a type specimen book.
               </p>
               <p>
                  <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
               </p>
            </div>
            <div class="col-md-6">
               <div class="inqbox-content">
               <h2><center><span style="color: red"> <?php
                              $message=Session::get('message');
                              if($message)
                              {
                                 echo $message;
                                 Session::put('message',null);
                              }
                            ?></span></center> </h2>
                  <form class="m-t" role="form" action="{{URL::to('login-admin')}}">
                     <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required="">
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="">
                     </div>
                     <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                     <a href="#">
                     <small>Forgot password?</small>
                     </a>
                     <p class="text-muted text-center">
                        <small>Do not have an account?</small>
                     </p>
                     <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                  </form>
                  <p class="m-t">
                     <small>InQ we app framework base on Bootstrap 3 &copy; 2015</small>
                  </p>
               </div>
            </div>
         </div>
         <hr/>
         <div class="row">
            <div class="col-md-6">
               Copyright Your Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2015-2016</small>
            </div>
         </div>
      </div>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>

</script>