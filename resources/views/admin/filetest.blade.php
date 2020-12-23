<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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

               
               <div class="row">
                  <div class="col-lg-9">
                     <div class="animated fadeInUp">
                        <div class="inqbox">
                           <div class="inqbox-content">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="m-b-md">
                                       <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>
                                       <h2>Lorem Ipsum Project</h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                       <dt>Status:</dt>
                                       <dd><span class="label label-primary">Active</span></dd>
                                    </dl>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-5">
                                    <dl class="dl-horizontal">
                                       <dt>Created by:</dt>
                                       <dd>Aldin Richard</dd>
                                       <dt>Messages:</dt>
                                       <dd>  102</dd>
                                       <dt>Client:</dt>
                                       <dd><a href="#" class="text-navy"> ABC Corporation</a> </dd>
                                       <dt>Version:</dt>
                                       <dd> 	v5.4.2 </dd>
                                    </dl>
                                 </div>
                                 <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >
                                       <dt>Last Updated:</dt>
                                       <dd>16.08.2015 05:15:57</dd>
                                       <dt>Created:</dt>
                                       <dd> 	11.07.2015 25:36:57 </dd>
                                       <dt>Participants:</dt>
                                       <dd class="project-people">
                                         <a href="#"><img alt="image" class="img-circle" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=128%C3%97128&w=128&h=128"></a>
                                       </dd>
                                    </dl>
                                 </div>
                              </div>
                         
                              <div class="row m-t-sm">
                                 <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                       <div class="panel-heading">
                                          <div class="panel-options">
                                             <ul class="nav nav-tabs tab-border-top-danger">
                                                <li class="active"><a href="#tab-1" data-toggle="tab">Users messages</a></li>
                                             </ul>
                                          </div>
                                       </div>

                                       <div class="panel-body">
                                          <div class="tab-content">
                                             <div class="tab-pane active" id="tab-1">
                                                <div class="feed-activity-list">
                                                   <div class="feed-element">
                                                      <div class="media-body ">
                                                         <strong>Mark Kyleson</strong> posted message on <strong>Monica Mendoza</strong> site. <br>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="project-manager">
                        <h4>Project description</h4>
                        <img src="http://placeholdit.imgix.net/~text?txtsize=40&txt=200x71&w=200&h=71" class="img-responsive">
                        <p class="small">
                           There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                           even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
                        </p>
                        <p class="small font-bold">
                           <span><i class="fa fa-circle text-warning"></i> High priority</span>
                        </p>
                        <h5>Project tag</h5>
                        <ul class="tag-list">
                           <li><a href="#"><i class="fa fa-tag"></i> PHP</a></li>
                           <li><a href="#"><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                           <li><a href="#"><i class="fa fa-tag"></i> Passages</a></li>
                           <li><a href="#"><i class="fa fa-tag"></i> Variations</a></li>
                        </ul>
                        <h5>Project files</h5>
                        <ul class="list-unstyled project-files">
                           <li><a href="#"><i class="fa fa-file"></i> Project_document.docx</a></li>
                           <li><a href="#"><i class="fa fa-file-picture-o"></i> Logo_ABC_company.jpg</a></li>
                           <li><a href="#"><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                           <li><a href="#"><i class="fa fa-file"></i> Contract_20_11_2015.docx</a></li>
                        </ul>
                        <div class="text-center m-t-md">
                           <a href="#" class="btn btn-xs btn-primary">Add files</a>
                           <a href="#" class="btn btn-xs btn-primary">Report contact</a>
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
           
     
   </body>
</html>