<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> HOSPITAL BOOKING </title>
        <!-- img -->
   
        <!--  -->
        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <!-- Toastr style -->
        <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
        <!-- Gritter -->
        <link href="{{ asset('backend/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
        <!-- morris -->
        <link href="{{ asset('backend/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
        <link href="{{ asset('backend/css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('backend/css/forms/kforms.css')}}" rel="stylesheet">
        <!-- Summernote CSS  -->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/summernote/summernote.css')}}">
        
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side fixed-menu" role="navigation">
                <div class="sidebar-collapse">
                    <div id="hover-menu"></div>
                    <ul class="nav metismenu" id="side-menu">
                        <li>
                            <div class="logopanel" style="margin-left: 0px; z-index: 99999">
                                <div class="profile-element">
                                    <h2><a href="#">Trang Admin</a></h2>
                                </div>
                                <div class="logo-element">
                                  
                                </div>
                            </div>
                        </li>
                        <li>
                
                            <div class="leftpanel-userinfo collapse" id="loguserinfo" style="position: absolute; background: #3b4354!important">
                                <h5 class="sidebar-title">Address</h5>
                                <address>
                                    Dumaguete Negros Is.
                                    Philippines 6200
                                </address>
                                <h5 class="sidebar-title">Contact</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <label class="pull-left">Email</label>
                                        <span class="pull-right">demo@softreliance.com</span>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="pull-left">Home</label>
                                        <span class="pull-right">(032) 1234 567</span>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="pull-left">Mobile</label>
                                        <span class="pull-right">+63012 3456 789</span>
                                    </li>
                                    <li class="list-group-item">
                                        <label class="pull-left">Social</label>
                                        <div class="social-icons pull-right">
                                            <a href="#"><i class="fa fa-facebook-official"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <!-- START : Left sidebar -->
                            <div class="nano left-sidebar">
                                <div class="nano-content">
                                    <ul class="nav nav-pills nav-stacked nav-inq">
                                        <li class="active">
                                            <a href="#"><i class="fa fa-home"></i> <span class="nav-label"> Dashboards </span></a>
                                        </li>
                                       
                                        @foreach($permission as $key=> $v)
                                        @if($v->permission == 'account_service')
                                        <li class="nav-parent">
                                            <a href="#"><i><img src="{{asset ('backend/icon/product management.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                            <ul class="children nav">
                                                <li><a href="{{URL::to('/all-service-service')}}"> Danh sách dịch vụ khám</a></li>
                                                <li><a href="{{URL::to('/all-service-packet')}}"> Danh sách gói khám</a></li>
                                                <li><a href="{{URL::to('/disable-service-service')}}"> Dịch vụ bị vô hiệu hóa</a></li>
                                            </ul>
                                        </li>
                                        @endif
                                        @if($v->permission == 'account_news')
                                        <li>
                                            <a href="{{URL::to('/news')}}"><i><img src="{{asset ('backend/icon/Post management.svg')}}"></i><span class="nav-label"> {{$v->description}} </span></a>                                           
                                        </li>
                                        @endif
                                        @if($v->permission == 'account_control')
                                        <li class="nav-parent">
                                            <a href="#"><i><img src="{{asset ('backend/icon/employee management.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                            <ul class="children nav">
                                                <li><a href="{{URL::to('/all-account-admin')}}"> Danh sách tài khoản</a></li>
                                                <li><a href="{{URL::to('/all-account-permission')}}"> Quản lý quyền hạn module</a></li>
                                                <li><a href="{{URL::to('/all-account-type')}}"> Quản lý loại tài khoản</a></li>
                                            </ul>
                                        </li>
                                        @endif
                                         @if($v->permission == 'account_orders')
                                        <li >
                                            <a href="{{URL::to('/all-billing')}}"><i><img src="{{asset ('backend/icon/order management.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                        </li>
                                        @endif
                                         @if($v->permission == 'account_slide')
                                        <li >
                                            <a href="{{URL::to('/all-slide')}}"><i><img src="{{asset ('backend/icon/slide management.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                        </li>
                                        @endif
                                        @if($v->permission == 'account_customer')
                                        <li>
                                            <a href="{{URL::to('/all-account-customer')}}"><i><img src="{{asset ('backend/icon/customer manager.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                        </li>
                                        @endif
                                        @if($v->permission == 'account_force_signout') 
                                        <li >
                                            <a href="{{URL::to('/force-sign-out')}}"><i><img  src="{{asset ('backend/icon/force sign out.svg')}}"></i> <span class="nav-label"> {{$v->description}} </span></a>
                                        </li>
                                        @endif
                                     @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- END : Left sidebar -->
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg">
                <!-- BEGIN HEADER -->
                <div id="header">
                    <nav class="navbar navbar-fixed-top white-bg show-menu-full" id="nav" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn" href="javascript:void(0)"><i class="fa fa-bars" style="font-size:27px;"></i> </a>
                            {{--  <form role="search" class="navbar-form-custom">
                                <div class="form-group">
                                    <div class="kform inq">
                                        <div>
                                            <label class="field append-icon">
                                                <input type="text" name="search" id="search" class="gui-input" placeholder="Type your search here...">
                                                <span class="field-icon">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>  --}}
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                           
                            <li class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <span class="pl15">
                                    <i  class="fa fa-user"></i>
                                      <?php
                                        $full_name = Session::get('full_name');
                                        $id =Session::get('id');
                                        if($id)
                                        {
                                            echo $full_name." ";
                                          //  echo $id;
                                        }
                                    
                                    ?>  </span>
                                    <span class="caret caret-tp"></span>
                                </a>
                                <ul class="dropdown-menu animated m-t-xs">
                           
                                    <li class="divider"></li>
                                     
                                    <li><a onClick="show_modal()" class="animated animated-short fadeInUp"><i class="fa fa-sign"></i> Thay đổi mật khẩu </a></li>
                                    <li><a href="{{URL::to('/logout-admin')}}" class="animated animated-short fadeInUp"><i class="fa fa-sign-out"></i> Đăng xuất </a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- END HEADER -->
    <div id="change_password" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title"> Thay đổi mật khẩu</h4>
              </div>
              <div class="modal-body">

            <form id="change_password_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label> Mật khẩu cũ (<font style="color: red">*</font>)</label>
            <input type="password" name="old_password" id="old_password" class="form-control" />
            <br/>
             <label> Mật khẩu mới (<font style="color: red">*</font>)</label>
             <input type="password" onkeyup="checkPass()" name="new_password" id="new_password" class="form-control" />
            <br/>
            <label> Xác nhận mật khẩu  (<font style="color: red">*</font>)</label>
            <input type="password" onkeyup="checkPass()"  name="confirm_password" id="confirm_password" class="form-control" />
            <input type="hidden" name="id_admin" value="{{$id}}" id="id_admin" class="form-control" />
            <br/>
            <div id="error-nwl"></div>
            <br/>
            <button class="btn btn-default" type="button" onclick="show_password()"><i class="fa fa-eye"></i></button>
            <br/><br/>
            <input type="submit"  name="update" id="insert_category" value="Xác nhận" class="btn btn-success" />
           </form>
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal"> Đóng </button>
              </div>
             </div>
            </div>
           </div>

   
              
                  
                           
                @yield('admin_content')



                           
            <div class="footer">
               <div class="pull-right">
                  10GB of <strong>250GB</strong> Free.
               </div>
               <div>
                  <strong>Copyright</strong> Your Company &copy; 2015-2016
               </div>
            </div>           
             

      
            <!-- Mainly scripts -->
            <script src="{{ asset('backend/js/jquery-2.1.1.js')}}"></script>
            <script src="{{ asset('backend/js/bootstrap.min.js')}}"></script>
            <script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
            <script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
            <!-- Morris -->
            
           
            <script src="{{ asset('backend/js/plugins/morris/morris.js')}}"></script>
            <!-- Chartist -->
           
            <!-- Custom and plugin javascript -->
            <script src="{{ asset('backend/js/main.js')}}"></script>
            <script src="{{ asset('backend/js/plugins/pace/pace.min.js')}}"></script>
            <!-- Jvectormap -->
            <script src="{{ asset('backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
            <script src="{{ asset('backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
            <!-- Sparkline -->
            <script src="{{ asset('backend/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
            <!-- Sparkline demo data  -->
            <script src="{{ asset('backend/js/demo/sparkline-demo.js')}}"></script>
            <script src="{{ asset('backend/js/plugins/chartJs/Chart.min.js')}}"></script>
            <!-- Ckeditor JS -->
            <script src="{{ asset('backend/js/plugins/ckeditor/ckeditor.js')}}"></script>
            <!-- Summernote Plugin -->
            <script src="{{ asset('backend/js/plugins/summernote/summernote.min.js')}}"></script>
            <script>
            $(document).ready(function () {
                "use strict";
                // Add slimscroll to element
                $('.full-height-scroll').slimscroll({
                    height: '100%'
                });
            });
            </script>
            <script>

            function show_modal()
            {
            $('#change_password').modal('show');
            }
            $( document ).ready(function() {
                $('#change_password').on('hidden.bs.modal', function () {
                $(this).find("input,textarea").val('').end();
                });

            $('#change_password_form').on('submit', function(event) {
                    event.preventDefault();
                    var new_password = $('#new_password').val();
                    var confirm_password = $('#confirm_password').val();
                   // console.log(new_password); console.log(confirm_password);
                    if(new_password == confirm_password)
                    {
                        $.ajax({
                        url: '{{URL::to('/change-password-admin')}}',
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) 
                        {
                            alert(response['mes']);
                        }
                    });
                    $('#change_password').modal('hide');
                    }else{
                        alert('Mật khẩu không trùng khớp');
                    }
                });
            });

            function show_password(){
            var x = document.getElementById("confirm_password");
            var y = document.getElementById("old_password");
            var z = document.getElementById("new_password");
            if (x.type === "password" ) {
                x.type = "text";
                y.type = "text";
                z.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
                z.type = "password";
                }
            }
            
            function checkPass() {
            var neutralColor = '#fff'; // 'white';
            var badColor     = '#f66'; // 'red';
            var goodColor    = '#6f6'; // 'green';
            
            var password1 = getElm('new_password').value;
            var password2 = getElm('confirm_password').value;

            //if password length is less than 6
            if (password1.length < 6) {
                feedback('Mật khẩu tối thiểu 6 kí tự');
                //we do not care about pass2 when pass1 is too short
                setBGColor('confirm_password', neutralColor);
                //if pass1 is blank, set neutral background
                if (password1.length === 0) {
                setBGColor('new_password', neutralColor);
                } else {
                setBGColor('new_password', badColor);
                }
            //else if passwords do not match
            } else if (password2 !== password1) {
                //we now know that pass1 is long enough
                feedback('Xác nhận mật khẩu');
                setBGColor('new_password', goodColor);
                //if pass2 is blank, set neutral background
                if (password2.length === 0) {
                setBGColor('confirm_password', neutralColor);
                } else {
                setBGColor('confirm_password', badColor);
                }
            //else all is well
            } else {
                feedback('Mật khẩu trùng khớp');
                setBGColor('new_password', goodColor);
                setBGColor('confirm_password', goodColor);
            }
            }

            //helper function for document.getElementById()
            function getElm(id) {
            return document.getElementById(id);
            }

            //helper function for setting background color
            function setBGColor(id, value) {
            getElm(id).style.backgroundColor = value;
            }

            //helper function for feedback message
            function feedback(msg) {
            getElm('error-nwl').innerHTML = msg;
            }


        </script>        
                
    </body>
</html>