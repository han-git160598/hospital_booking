<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>InQ - A Responsive Bootstrap 3 Admin Dashboard Template</title>
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
         <div id="page-wrapper" class="gray-bg">
            <div>
               <nav class="navbar navbar-fixed-top white-bg show-menu-full" id="nav" role="navigation" style="margin-bottom: 0">
                  <div class="navbar-header">
                     <a class="navbar-minimalize minimalize-styl-2 btn" href="javascript:void(0)"><i class="fa fa-bars" style="font-size:27px;"></i> </a>
                     <form role="search" class="navbar-form-custom">
                        <div class="form-group">
                           <div class="kform inq">
                              <div>
                                 <label class="field append-icon">
                                 <input type="text" name="search" id="search" class="gui-input" placeholder="Type your search here...">
                                 <label for="search" class="field-icon">
                                 <i class="fa fa-search"></i>
                                 </label>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <ul class="nav navbar-top-links navbar-right">
                     <li class="dropdown hidden-xs">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-danger">4</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                           <li>
                              <div class="dropdown-messages-box">
                                 <a href="profile.html" class="pull-left animated animated-short fadeInUp">
                                 <img alt="image" class="img-circle" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128">
                                 </a>
                                 <div class="animated animated-short fadeInUp">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Alden Richards</strong> started following <strong>Maine Mendoza</strong>. <br>
                                    <small class="text-muted">2 days ago at 6:58 pm - 08.06.2015</small>
                                 </div>
                              </div>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <div class="dropdown-messages-box">
                                 <a href="profile.html" class="pull-left animated animated-short fadeInUp">
                                 <img alt="image" class="img-circle" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128">
                                 </a>
                                 <div class="animated animated-short fadeInUp">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Paulo Ballesteros</strong> started following <strong>Alden Richards</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 08.06.2015</small>
                                 </div>
                              </div>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <div class="dropdown-messages-box">
                                 <a href="profile.html" class="pull-left animated animated-short fadeInUp">
                                 <img alt="image" class="img-circle" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128">
                                 </a>
                                 <div class="animated animated-short fadeInUp">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Maine Mendoza</strong> love <strong>Alden Richards</strong>. <br>
                                    <small class="text-muted">3 days ago at 2:30 am - 11.06.2015</small>
                                 </div>
                              </div>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <div class="text-center link-block">
                                 <a href="mailbox.html" class="animated animated-short fadeInUp">
                                 <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                 </a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <li class="dropdown hidden-xs">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-danger">5</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                           <li>
                              <a href="mailbox.html" class="animated animated-short fadeInUp">
                                 <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                 </div>
                              </a>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <a href="profile.html" class="animated animated-short fadeInUp">
                                 <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                 </div>
                              </a>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <a href="grid_options.html" class="animated animated-short fadeInUp">
                                 <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                 </div>
                              </a>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <div class="text-center link-block">
                                 <a href="notifications.html" class="animated animated-short fadeInUp">
                                 <strong>See All Alerts</strong>
                                 <i class="fa fa-angle-right"></i>
                                 </a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="pl15"> Rhian Santos </span>
                        <span class="caret caret-tp"></span>
                        </a>
                        <ul class="dropdown-menu animated m-t-xs">
                           <li><a href="profile.html" class="animated animated-short fadeInUp"><i class="fa fa-user"></i> Profile</a></li>
                           <li><a href="contacts.html" class="animated animated-short fadeInUp"><i class="fa fa-group"></i> Contacts</a></li>
                           <li><a href="mailbox.html" class="animated animated-short fadeInUp"><i class="fa fa-inbox"></i> Mailbox</a></li>
                           <li class="divider"></li>
                           <li><a href="login.html" class="animated animated-short fadeInUp"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                     </li>
                  </ul>
               </nav>
            </div>
            <div style="clear: both; height: 61px;"></div>
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="inqbox float-e-margins">
                        <div class="inqbox-content">
                           <h2>Clients</h2>
                           <ol class="breadcrumb">
                              <li>
                                 <a href="index.html">Home</a>
                              </li>
                              <li>
                                 <a>Apps</a>
                              </li>
                              <li class="active">
                                 <strong>Clients</strong>
                              </li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-8">
                     <div class="inqbox">
                        <div class="inqbox-content">
                           <span class="text-muted small pull-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2015</span>
                           <h2>Clients</h2>
                           <p>
                              All clients need to be verified before you can send email and set a project.
                           </p>
                           <div class="input-group">
                              <input type="text" placeholder="Search client " class="input form-control">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                              </span>
                           </div>
                           <div class="clients-list">
                              <ul class="nav nav-tabs tab-border-top-danger">
                                 <span class="pull-right small text-muted">1406 Elements</span>
                                 <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Contacts</a></li>
                                 <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Companies</a></li>
                              </ul>
                              <div class="tab-content">
                                 <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                       <div class="table-responsive">
                                          <table class="table table-striped table-hover">
                                             <tbody>
                                                <tr>
                                                   <td class="client-avatar"><img alt="image" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128"> </td>
                                                   <td><a data-toggle="tab" href="#contact-1" class="client-link">Anthony Jackson</a></td>
                                                   <td> Tellus Institute</td>
                                                   <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                   <td> gravida@rbisit.com</td>
                                                   <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                            
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                       <div class="table-responsive">
                                          <table class="table table-striped table-hover">
                                             <tbody>
                                                <tr>
                                                   <td><a data-toggle="tab" href="#company-1" class="client-link">Tellus Institute</a></td>
                                                   <td>Rexton</td>
                                                   <td><i class="fa fa-flag"></i> Angola</td>
                                                   <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                   <td><a data-toggle="tab" href="#company-2" class="client-link">Velit Industries</a></td>
                                                   <td>Maglie</td>
                                                   <td><i class="fa fa-flag"></i> Luxembourg</td>
                                                   <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                              
                                              
                                             
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="inqbox ">
                        <div class="inqbox-content">
                           <div class="tab-content">
                              <div id="contact-1" class="tab-pane active">
                                 <div class="row m-b-lg">
                                    <div class="col-lg-4 text-center">
                                       <h2>Nicki Smith</h2>
                                       <div class="m-b-sm">
                                          <img alt="image" class="img-circle" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128"
                                             style="width: 62px">
                                       </div>
                                    </div>
                                    <div class="col-lg-8">
                                       <strong>
                                       About me
                                       </strong>
                                       <p>
                                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                          tempor incididunt ut labore et dolore magna aliqua.
                                       </p>
                                       <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                          class="fa fa-envelope"></i> Send Message
                                       </button>
                                    </div>
                                 </div>
                                 
                              </div>
                           
                             
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer">
               <div class="pull-right">
                  10GB of <strong>250GB</strong> Free.
               </div>
               <div>
                  <strong>Copyright</strong> Your Company &copy; 2015-2016
               </div>
            </div>
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
   </body>
</html>
