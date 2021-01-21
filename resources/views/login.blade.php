<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> HOSPITAL BOOKING </title>
      <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('backend/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
      <link href="{{ asset('backend/css/animate.css')}}" rel="stylesheet">
      <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">
   </head>
   <body class="gray-bg">
      <div class="loginColumns animated fadeInDown">
      <hr>
         <div class="row">
            <div class="col-md-6">
             <center> <p><img  alt="" height="200px" width="200px" src="{{ asset('backend/img/logo.png')}}"></p></center>
            <center>  <h3><p><strong style="color:black;">
                CÔNG TY CỔ PHẦN INFORMATICS QTC
              </strong ></p></h3></center>
            </div>
             
            <div class="col-md-6">
               <div class="inqbox-content">
               <h4><center><span style="color: red"> <?php
                              $message=Session::get('message');
                              if($message)
                              {
                                 echo $message;
                                 Session::put('message',null);
                              }
                            ?></span></center> </h4>
                  <form class="m-t" role="form" action="{{URL::to('login-admin')}}">
                     <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required="">
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="">
                     </div>
                     <button type="submit" class="btn btn-primary block full-width m-b"> Đăng nhập </button>
                     <div class="hr-line-dashed"></div>   
                  </form>
               </div>
            </div>
         </div>
      <hr/>  
      </div>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>

</script>