@extends('dashboard')
@section('admin_content') 
   <body> 
   <div style="clear: both; height: 61px;"></div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
         <div class="col-lg-12">
            <div class="inqbox float-e-margins">
               <div class="inqbox-content">
                  <h2>Basic Form</h2>
                  <ol class="breadcrumb">
                     <li>
                        <a href="index.html">Home</a>
                     </li>
                     <li>
                        <a>Forms</a>
                     </li>
                     <li class="active">
                        <strong>Basic Form</strong>
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      
      
      <div class="row">
         <div class="col-lg-12">
            <div class="inqbox float-e-margins">
               <div class="inqbox-title">
                  <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
                  <div class="inqbox-tools">
                     <a class="collapse-link">
                     <i class="fa fa-chevron-up"></i>
                     </a>
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <i class="fa fa-wrench"></i>
                     </a>
                     <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                     </ul>
                     <a class="close-link">
                     <i class="fa fa-times"></i>
                     </a>
                  </div>
               </div>
              
             
               <div class="inqbox-content">
                <div  class="form-horizontal">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Tên dịch vụ</label>
                        <div class="col-sm-10"><input type="text" id="service" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Giá</label>
                        <div class="col-sm-10"><input type="text" id="price" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Nội dung</label>
                        <div class="col-sm-10"><input type="text" id="content" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>

                     

                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                           <a href="{{URL::to('all-service-service')}}" class="btn btn-white" type="btn">Quay lại danh sách</a>
                           <button class="btn btn-primary" type="btn" id="save_service">Lưu nội dung</button>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
  
</body>

<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

<script>
$("#save_service").click( function(){
      var service1=$('#service').val();
      var content1=$('#content').val();
      var price1=$('#price').val();
      console.log(service1);
      console.log(content1);
      console.log(price1);
      $.ajax({
               url: '{{URL::to('/save-service-service')}}',
               type: 'GET',
               data: {service: service1, content: content1, price: price1 },
               dataType: 'json',
               success: function (response) 
               {
                  alert(response['mes']);
               }
            });    
});

</script>
@endsection