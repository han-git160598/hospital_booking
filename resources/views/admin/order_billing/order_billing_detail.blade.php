@extends('dashboard')
@section('admin_content') 

<div style="clear: both; height:63px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12"> 
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> CHI TIẾT HÓA ĐƠN </h2>
                   
                </div>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-sm-8">
                <div class="inqbox">
                <div class="inqbox-content">
                <span class="text-muted big pull-right"><a href="{{URL::to('/all-billing')}}" ></a></span>
                    <h2> @if($data['billing'][0]->billing_type == 1)
                                <strong>Khám cá nhân </strong>
                            @else
                                <strong>Khám hộ</strong>
                            @endif
                    </h2>

                    <div class="clients-list">
                         @foreach($data['billing'] as $v)
                        
                        <ul class="nav nav-tabs tab-border-top-danger">
             
                            <li class="active"><a data-toggle="tab" href="#tab-1" onClick="billing_detail({{$data['billing'][0]->id}})">Thông tin bill</a></li>
                         
                            <li class=""><a data-toggle="tab" href="#" onClick="customer_detail({{$v->id}})">Khách hàng</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="service_detail({{$v->id}})">Dịch vụ</a></li>
                            @if($v->billing_status != 5 )
                            <li class=""><a data-toggle="tab" href="#" onClick="actually_detail({{$v->id}})">Phát sinh</a></li>
                           @endif
                           @if($v->billing_status == 1 || $v->billing_status == 2|| $v->billing_status == 3 )
                            <li class=""><a data-toggle="tab" href="#" onClick="appointment_detail({{$v->id}})">Tạo lịch trình</a></li>
                            @endif
                         
                        </ul>
                        @break
                        @endforeach
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
     
                                        <tbody>
                                        <tr>
                                            <th style="width:30px;"></th>
                                            <th>Mã đơn hàng </th>
                                            <th>Thời gian hẹn </th>
                                            <th>Trạng thái</th>
                                            <th style="width:30px;"></th>
                                        
                                        </tr>
                                       @foreach($data['billing'] as $v)  
                                        <tr>
                                            <td style="width:30px;"></td>
                                            <td><p> {{$v->billing_code}}</p></td>
                                            <td  id="date_time">{{$v->billing_date}} | {{$v->billing_time}} 
                                            @if($v->billing_status == 1)
                                            <button  onClick="edit_time()"  class="btn btn-success btn-sm"> Sửa</button>
                                            @endif
                                            </td>
                                            <td id="status_bill">
                                            @if($v->billing_status ==1)
                                            <p>Chờ xác nhận</p>
                                            @elseif ($v->billing_status==2)
                                            <p>Đã đặt lịch</p>
                                            @elseif ($v->billing_status==3)
                                            <p> Đã chuyển khoản </p>
                                            @elseif ($v->billing_status==4)
                                            <p>Hoàn tất</p>
                                            @else
                                            <p> Hủy bỏ</p>
                                            @endif
                                            </td>
                                            <td style="width:30px;"></td>
                                           
                                        </tr>
                                        
                                       @endforeach 
                                        </tbody>
                                    </table>
                                    @if($v->billing_status==5 )
                                    @elseif($v->billing_status==4)
                                    @elseif($v->billing_status==1)
                                    <h3 style="float:right;width:50%;"><center><tr>
                                    <td>
                                    <button onClick="cancel_bill()" id="cancel_bill"  class="btn btn-primary btn-sm">Hủy đơn</button>
                                    </td>
                                    <td><button onClick="update_status_bill({{$data['billing'][0]->id}})" class="btn btn-primary btn-sm" >Xác nhận</button></td>
                                    </tr></center></h3>     
                                    @elseif($v->billing_status==3)
                                    <h3 style="float:right;width:50%;"><center><tr>
                                    <td><button onClick="update_status_bill({{$data['billing'][0]->id}})" class="btn btn-primary btn-sm" > Hoàn tất </button></td>
                                    </tr></center></h3>  
                                    @else
                                    <h3 style="float:right;width:50%;"><center><tr>
                                    <td><button onClick="update_status_bill({{$data['billing'][0]->id}})" class="btn btn-primary btn-sm" >Xác nhận</button></td>
                                    </tr></center></h3>                                  
                                    @endif
                                    </div>
                            </div>
                            </div>

                           
  

                        </div>

                    </div>
                </div>
                </div>
            </div>
            <!-- modal dialog -->
<div id="add_appointment" class="modal fade">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"> Lịch khám </h4>
      </div>
      <div class="modal-body">
       <form method="post" id="insert_form_appointment">
       <div id="">    
       
       </div>

        
       </form>
      </div>
      <div class="modal-footer">
       <button type="button" data-dismiss="modal" id="insert_service" onClick="insert_service({{$data['billing'][0]->id}})" class="btn btn-success">Thêm dịch vụ</button>
       <button type="button" class="btn btn-default" data-dismiss="modal"> Đóng </button>
      </div>
     </div>
    </div>
</div>
        <!-- {{--  ////////////////////////danh sách dịch vụ/////////////////////////  --}} -->

<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Danh sách dịch vụ</h4>
      </div>
      <div class="modal-body">
       <form method="post" id="insert_form_service">
       <div class="pre-scrollable">
       <input type="text" id="search_service_actually" onkeyup="search_service()">
       <div id="list_service2">    
       
       </div>

        
       </form>
       </div>
      </div>
      <div class="modal-footer">
       <button type="button" data-dismiss="modal" id="insert_service" onClick="insert_service({{$data['billing'][0]->id}})" class="btn btn-success">Thêm dịch vụ</button>
       <button type="button" class="btn btn-default" data-dismiss="modal"> Đóng </button>
      </div>
     </div>
    </div>
</div>
     <!-- {{--  ////////////////////////model/////////////////////////  --}} -->
                                    <!-- {{--  <!-- Simple pop-up dialog box containing a form -->  --}} -->
                                    <dialog id="favDialog">
                                    <form method="dialog">
                                     
                                        <h2><strong> Vui lòng nhập lý do hủy đơn !</strong></h2>
                                     
                                        <tr><td>
                                        <textarea id="bill_comment" rows="4" cols="50"></textarea>
                                        </td></tr>
                                       
                                        <menu>
                                        <button>Từ chối</button>
                                        <button onClick="cancel_order({{$data['billing'][0]->id}})">Hoàn thành</button>
                                        </menu>
                                        
                                    </form>
                                    </dialog>
                                    

            <!-- Simple pop-up dialog box containing a form -->

<dialog id="dialogtime">
<form method="dialog">
    <p><label>Chọn lại thời gian:
    <input type="date" id="billing_date">
    <input type="time" id="billing_time">
    </label></p>
    <menu>
    <button>Trở lại</button>
    <button onClick="update_billing_date({{$data['billing'][0]->id}})">Xác nhận</button>
    </menu>
</form>
</dialog>
<!-- ----------------------------- Tổng tiền ---------------------------------- -->
    
            <div class="col-sm-4">
                <div class="inqbox ">
                <div class="inqbox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">
                           
                            <div >  
                              <center>  <h1 ><strong> <i class="fa fa-money"></i> Tổng tiền </strong> </h1>  </center>   
                            </div>
                            @if(isset($total_billing))
                             <div  id="total_billing">
                             <center> <h2> <strong style="color:green;"><i class="fa fa-glyphicon glyphicon-euro"></i> {{number_format($total_billing)}} VND </strong> </h2>
                            </div>
                            @endif 
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
            </div>
      
            
<!-- ----------------------------- thanh toán----------------------------------- -->
            @if($data['billing'][0]->billing_status != 5)
            <div class="col-sm-4">
                <div class="inqbox ">
                <div class="inqbox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">
                           
                            <div >  
                              <center>  <h2 ><strong><i class="fa fa-credit-card"></i>  PT thanh toán </strong> </h2>  </center>
                              
                            </div>
                            <div class="col-lg-12">
                            @if($data['billing'][0]->payment_type== 1)
                          
                            <center> <h3> <span style="color:blue;"><i><img src="{{asset ('backend/icon/cash in hand.svg')}}"></i> <i><img src="{{asset ('backend/icon/Thanh toán chi phí tại bệnh viện.svg')}}"></i> </span> </h3> 
                            
                            @else
                            <center> <h3> <span style="color:blue;"><i><img src="{{asset ('backend/icon/online payment.svg')}}"></i> <i><img src="{{asset ('backend/icon/Thanh toán chi phí qua chuyển khoản.svg')}}"></i> </span> </h3>
                            <form id="insert_img_payment" enctype="multipart/form-data">
                            <input type="file" name ="img_payment"></br>
                            <input type="hidden" id="id_billing1" name ="id_billing" value="{{$data['billing'][0]->id}}">
                            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-upload"></i>  Tải hình lên </button>
                            </form>
                            <div id="show_img_payment">
                            <div class="hr-line-dashed"></div>     
                            @foreach($data['billing'] as $va)
                            @if(isset($va->payment_image))
                            <a target="_blank" href="{{ asset($va->payment_image) }}" class="imgpreview">
                            <img src="{{ asset($va->payment_image) }}" alt="gallery thumbnail" height="200" width="270" /></a>
                          
                            @endif                      
                            @endforeach
                            </div>

                            @endif    
                            </div>
                            </div>
                            
                        </div>
                    
                        
                    </div>
                </div> 
                </div>
            </div>
      
<!-- ---------------------------hình ảnh kết quả--------------------------------------------------- -->
            <div class="col-sm-4">
                <div class="inqbox ">
                <div class="inqbox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                        
                            <div class="row m-b-lg" >
                            <div>
                            <center>  <h1 ><strong><i class="fa fa-image"></i> Kết quả khám </strong> </h1>  </center>
                            </div>
                            <div class="col-lg-12">
                            
                                <strong>
                                <h3> Hình ảnh <i class="fa fa-image"></i></h3>
                                </strong>
                                <form id="insert_img_result" enctype="multipart/form-data">
                                <input type="file" name ="img_billing_document"></br>
                                <input type="hidden" id="id_billing" name ="id_billing" value="{{$data['billing'][0]->id}}">
                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-upload"></i>  Tải hình lên </button>
                                </form>
                                <div class="pre-scrollable">
                                <div id="show_img">

                              
                                <div class="hr-line-dashed"></div>     
                                @foreach($data['document'] as $v)
                                <a class="prop-entry d-block">
                                <button onClick="remove_img_document({{$v->id}})"><i class="fa fa-remove"></i></button>
                                <a target="_blank" href="../../{{$v->image_upload}}" class="imgpreview">
                                <img src="../../{{$v->image_upload}}" alt="gallery thumbnail" height="200" width="270" /></a>
                                </a>  
                                <div class="hr-line-dashed"></div>         
                                @endforeach
                                </div>
                               
                            </div>
                            </div>
                            
                        </div>
                    
                        
                    </div>
                </div>
                </div>
            </div>
            @else
            <div class="col-sm-4">
                <div class="inqbox ">
                <div class="inqbox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">

                            <div >  
                              <center>  <h3> <header>Lý do</header> </h3>  </center>
                              

                            <main role="main">
                               <blockquote><p> {{$data['billing'][0]->billing_comment}}</p></blockquote>
                            
                                
                            </main>

                             
                        </div>
                    
                        
                    </div>
                </div> 
                </div>
            </div>
            @endif

        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

<script>   
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
function service_detail(id)
{
  //  console.log(id);
   $.ajax({
        url: '{{URL::to('/service-detail')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {  
            console.log(response);
             var dem = 1;
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>STT</th>
                <th>Dịch vụ</th>
                <th>Giá dịch vụ</th>
                <th style="width:30px;"></th>   
            </tr>`;
            $('tbody').html('');
            var sum =0 ;
            response['service'].forEach(function (item) {
              //  console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${dem++}</p>
                </td>
                <td class="project-title">
                    <p><i><img src="{{asset ('backend/icon/detail appointment schedule.svg')}}"></i> ${item.service}</p>
                </td>
                <td class="project-title">
                    <p>${formatNumber(item.price)} VND</p>
                </td>
                <td style="width:30px;"></td>    
            </tr>`;
            sum +=parseInt(item.price); // billing_price
            });
             output+=`
            <tr><td style="width:30px;"></td><td colspan="2" style="color:black"><strong> Thành tiền: </strong></td>
            <td><strong style="color:black"> ${formatNumber(sum)} VND </strong></td></tr>
            
            <tr><td style="width:30px;"></td><td colspan="2" style="color:blue"><strong> Người khám : </strong></td>
            <td><strong style="color:blue"> X${response['total_person']}  </strong></td></tr>    
            <tr><td style="width:30px;"></td><td colspan="2" style="color:green"><strong> Tổng dịch vụ ban đầu : </strong></td>
            <td><strong style="color:green"> ${formatNumber(response['initial_total'])} VND  </strong></td></tr>
            `;
            $('tbody').html(output);   
        }
    });
}
function customer_detail(id)
{
    //console.log(id);
    $.ajax({
        url: '{{URL::to('/customer-detail')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);  
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Họ & Tên</th>
                <th>Số điện thoại</th>
                <th>địa chỉ</th>
                <th>Ngày sinh</th>
                <th>Giới tinh</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
             //   console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.customer_name}</p>
                </td>
                <td class="project-title">
                    <p>${item.customer_phone}</p>
                </td>
                <td class="project-title">
                    <p>${item.customer_address}</p>
                </td>
                <td class="project-title">
                    <p>${item.billing_date}</p>
                </td>
                <td class="project-title" >
                
                    <p>${item.customer_sex}</p>
                    <input type="hidden" id="${item.id}id_customer" value="${item.id}">
                </td>
                
                <td style="width:30px;"></td>    
            </tr>`;    
         
            output+=`
            <tr id="Tiensu">    
            <td colspan="7">
            <textarea id="add_prehistoric${item.id}" rows="4" cols="80">${item.prehistoric}</textarea>`;
            if(item.billing_status != 5 )
            output+=`
            <button class="btn btn-success btn-sm" onClick="add_prehistoric(${item.id})">Cập nhật tiền sử</button>`;
            output+=`
            </td>
            </tr>
            `;
            });
           
            $('tbody').html(output); 
        }
    });
}
function add_prehistoric(id)
{ 
    var r = confirm('Xác thực')
    if(r==true)
    { 
        var content = $('#add_prehistoric'+id).val();
        var id = $('#'+id+"id_customer").val();
        console.log(id);
        $.ajax({
            url: '{{URL::to('/add-prehistoric')}}',
            type: 'POST',
            data: {id:id,content:content},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function (response) 
            {
            console.log(response);
            output=`
                <td colspan="7">
                <textarea  id="add_prehistoric" rows="4" cols="80">${response}</textarea>
                <button class="btn btn-success btn-sm" onClick="add_prehistoric(`+id+`)">Cập nhật tiền sử</button>
                </td>
                `;   
                $('#Tiensu').html('');
                $('#Tiensu').html(output);
                alert('Cập nhật tiền sử thành công');
            }
        });
    }else{}
}
function actually_detail(id)
{   
    console.log(id);
     $.ajax({
        url: '{{URL::to('/actually-detail')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response)
         
            if(response.service == '')
            {
            var output=`
            <tr> Sửa
                <th style="width:30px;"></th>
                <th> Tên dịch vụ</th>
                <th> Đơn giá</th>
                <th> Số lượng</th>
                <th> Tổng</th>
                <th style="width:30px;"></th>
                 <th>
                <button type="button" onClick="list_service1()" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus"></i></button>
                </th>
            </tr>`;
            $('tbody').html('');
            $('tbody').html(output); 
            }else{
            console.log(response);
           // console.log(response[0].id_billing)
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th> Tên dịch vụ</th>
                <th> Đơn giá </th>
                <th> Số lượng</th>
                <th> Tổng </th>
                <th style="width:30px;"></th>
                <th>
                <button type="button" onClick="list_service1()" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus"></i></button>
                </th>
            </tr>`;
            $('tbody').html('');
            response.service.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                   <p><i><img src="{{asset ('backend/icon/detail appointment schedule.svg')}}"></i> ${item.service}</p>
                </td>
                <td class="project-title">
                    <p>${item.price}</p>
                </td>
                <td class="project-title">
                   <p><input style="width:40px;" type="number" id="${item.id_service}_quanlity" onChange="update_quanlity(${item.id_service},${item.id_billing})" min="1" value="${item.billing_quantity}" ></p>
                </td>
                <td class="project-title" id="${item.id_service}_billing_price">
                    <p>${formatNumber(item.billing_price)} VND</p>
                </td>
                <td >
                    <button type="button" class="btn btn-success btn-sm" onClick="remove_service(${item.id_service},${item.id_billing})"> Hủy </button>
                </td>
              
            </tr>
            `;    
            });
            output+=`
            <tr id="total_actually"><td style="width:30px;"></td><td colspan="3"><strong style="color:green"> Tổng phát sinh:</strong></td>
            <td colspan="2"><strong style="color:green"> ${formatNumber(response.total[0].total_actually)} VND</strong></td></tr>`;
            $('#total_billing').html(''); 
            var output_total=` <center> <h2> <strong style="color:green;"><i class="fa fa-glyphicon glyphicon-euro"></i> ${formatNumber(response.total_billing)} VND </strong> </h2>`;
            $('#total_billing').html(output_total); 
            $('tbody').html(output); 
            }
        
        }
     });
}
function billing_detail(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/billing-detail')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
        var output=`
            <tr> 
                <th style="width:30px;"></th>
                <<th>Mã đơn hàng</th>
                <th>Thời gian hẹn </th>
                <th>Trạng thái</th>
              
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
               console.log(item);
            output+=`
           <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.billing_code}</p>
                </td>
                <td class="project-title" id="date_time">
                    ${item.billing_date} | ${item.billing_time}`;
                if(item.billing_status ==1)
                 output+=`
                    <button onClick="edit_time()"  class="btn btn-success btn-sm"> Sửa </button>`;
                 output+=`
                </td>`;
                 if(item.billing_status ==1)
            output+=`<td> Chờ xác nhận </td>`;
                else if (item.billing_status==2)
            output+=`<td> Đã đặt lịch </td>`;
                else if (item.billing_status==3)
            output+=`<td> Đã chuyển khoản </td>`;
                else if (item.billing_status==4)
            output+=`<td>Hoàn tất</td>`;
                else
            output+=`<td>Hủy bỏ</td>`;
            output+=`
            
                <td style="width:30px;"></td>
                
            </tr>`;     
            });
            $('tbody').append(output); 
        }
    });
}
var arrtime= [];
function appointment_detail(id)
{ 
    arrtime =[];
  //  console.log(arrtime)
    $.ajax({
        url: '{{URL::to('/appointment-detail')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Dịch vụ</th>
                <th>Lịch hẹn</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th style="width:30px;"></th>   
                <th style="width:30px;"></th>   
            </tr>`;
            $('tbody').html('');
            response['service'].forEach(function (item) {
                //console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.service}</p>
                </td>
                <td class="project-title">
                <p>${item.appointment_time}</p>
                </td>
                <form id="${item.id}reset">
                <td class="project-title">
                    <input type="time"  id="${item.id}st">
                </td>
                <td class="project-title">
                    <input type="time" id="${item.id}ft">
                </td>
                </form>
                <td style="width:30px;"></td>
            </tr>`;  
            arrtime.push(item.id)
            });
            output+=`<tr><td colspan="5" >
            <center ><input type="button" class="btn btn-success btn-sm" onclick="add_appointment(${response['service'].id})" value="Đặt lịch">
           </center>
            </td></tr>`;
            $('tbody').html(output); 
            console.log(arrtime);
       
        }
    });
}
/// đặt thời gian khám
function add_appointment(id)
{
    var r = confirm('Bạn có thực sự muốn đặt lịch trình này, chỉ có thể thay đổi, không hủy được')
    if(r==true)
    {
    var a = arrtime;
    var arrlich =[];
    console.log(a); 
    for (i = 0; i <a.length; i++){
    var starttime = $('#'+a[i]+"st").val();
    var finishtime = $('#'+a[i]+"ft").val();   
    var id_bill1 =  $('#id_billing').val();   
   //  console.log(id_bill1);
     //console.log(starttime); 
     //console.log(finishtime); 
     arrlich.push({"id":a[i],"starttime":starttime,"finishtime":finishtime});
    }
    console.log(arrlich);
    $.ajax({
        url: '{{URL::to('/add-appointment')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{arrlich1:arrlich, id:id_bill1},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
            alert(response['mes']);
            // var output=``;
            // output = `  
            // <p>${item.appointment_time}<p>`;
        }
    });
    }else{}
}
function update_status_bill(id){
    console.log(id)
    var r = confirm('Kiểm tra lại thông tin trước khi xác nhận')
    if(r==true)
    {
        $.ajax({
        url: '{{URL::to('/update-status-bill')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{id:id},
        dataType: 'json',
        success: function (response) 
        {
            if(response['img']=='not_img'){
                alert(response['mes']);   
            }else{
            var output = ``;
            $('#status_bill').html('');
            console.log(response);
            alert(response['mes']);
            if(response['data'][0].billing_status ==1)
             output+= ` <p>Chờ xác nhận</p>`;
            else if (response['data'][0].billing_status==2)
             output+= `<p>Đã đặt lịch</p>`;
            else if (response['data'][0].billing_status==3)
            output+=` <p> Đã chuyển khoản </p>`;
            else if (response['data'][0].billing_status==4)
            {
            output+=`<p>Hoàn tất</p>`;
            location.reload();
            }
            else
            {
            output+= `<p> Hủy bỏ</p>`;
            location.reload();
            }
            $('#status_bill').html(output);
            }
        }
    });
   // location.reload();
    }else{
    }
}
function cancel_order(id)
{
    var r=confirm('Waring! Bạn có muốn hủy đơn này không !!');
    if(r==true)
    {
    var comment = $('#bill_comment').val();
    console.log(comment);
    console.log(id);
    $.ajax({
        url: '{{URL::to('/cancel-bill')}}'+'/'+id,
        type: 'GET',
        data: {billing_comment:comment },
        dataType: 'json',
        success: function (response) 
        {
             alert(response['mes']);
        }
    });
    location.reload();
    }else{
    }
   
  
}
/// huy don /////////////
function cancel_bill()
{
    var favDialog = document.getElementById('favDialog');
    favDialog.showModal();
    
}
// {{--  (function() {
//   var updateButton = document.getElementById('cancel_bill');
//   var favDialog = document.getElementById('favDialog');
//   // “Update details” button opens the <dialog> modally
//   updateButton.addEventListener('click', function() {
//     favDialog.showModal();
//   });
// })();  --}}
/// chon lai time ////////////
function update_billing_date(id)
{
    var r=confirm('Bạn có muốn thay đổi lịch hẹn không ?');
    if(r==true)
    {
    console.log(id);
    var date = $('#billing_date').val();
    var time = $('#billing_time').val();
    console.log(date);console.log(time);
     $.ajax({
        url: '{{URL::to('/update-billing-date-time')}}',
        type: 'GET',
        data:{id_billing:id, billing_date:date, billing_time:time},
        dataType: 'json',
        success: function (response) 
        {
            var output=``;
            $('#date_time').html('');
            response.forEach(function (item) {
            output+=`
                <td class="project-title">
                    <p>${item.billing_date} | ${item.billing_time}`; 
                    if(item.billing_status ==1)
                 output+=`
                    <button onClick="edit_time()"  class="btn btn-success btn-sm"> Sửa</button>`;
                 output+=`
                </td>
                    
                    <p>
                </td>`;    
            });
            $('#date_time').html(output);   
            alert('Thay đổi thời gian thành công')
        }
    });
    }else{}
    
}
function edit_time()
{
    var favDialog = document.getElementById('dialogtime');
    favDialog.showModal();
}
// (function() {
//   var updateButton = document.getElementById('edit_time');
//   var favDialog = document.getElementById('dialogtime');
//   // “Update details” button opens the <dialog> modally
//   updateButton.addEventListener('click', function() {
//     favDialog.showModal();
//   });
// })();
function list_service1()
{
    $.ajax({
        url: '{{URL::to('/list-service-service')}}',
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            
            console.log(response);
            var output=`
            <tr> 
                <th style="width:60px;"></th>
                <th >Tên dịch vụ</th>
                <th>Giá tiền</th>
    
                <th style="width:30px;"></th>
                <th style="width:20px;"></th>
      
            </tr>`;
            $('#list_service2').html('');
            response.forEach(function (item) {
                //console.log(item);
            output+=`
            <tr>
                <td style="width:60px;"></td>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${formatNumber(item.price)} VND</p> 
                </td>  
            
                <td class="project-title">
                    <p><input type="checkbox" autocomplete="off" id="checked_ck" value="${item.id}"> </p> 
                </td>
                <td style="width:20px;"></td>
            </tr>`;    
            });
            $('#list_service2').html(output); 
        }
    });
}
 function search_service()
 {
     var search = $('#search_service_actually').val();
    // console.log(search);
     $.ajax({
         url: '{{URL::to('/search-service-service')}}',
         type: 'POST',
         data: {service:search},
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         dataType: 'json',
         success: function (response) 
         {
            // console.log(response)
         var output=`
            <tr> 
                <th style="width:50px;"></th>
                <th>Tên dịch vụ</th>
                <th>Giá tiền</th>
                <th style="width:30px;"></th>
               <th style="width:20px;"></th>
            </tr>`;
           // $('#list_service2').html('');
            response.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>
                <td style="width:50px;"></td>
                <td class="project-title">
                    <p>${item.service}</p>  
               </td>
                <td class="project-title">
                    <p> ${item.price}</p> 
                </td>                
                 <td class="project-actions">
                     <input type="checkbox" value="${item.id}">
                 </td>                
                  <td style="width:20px;"></td>
             </tr>`;    
             });
             $('#list_service2').html(output); 
         }
     });
 }
function insert_service(id)
{
    var r = confirm('Kiểm tra lại thông tin trước khi xác nhận')
    if(r==true)
    {
   // console.log(id);
    var arr=[];
    $(':checkbox:checked').each(function(i){
       arr.push($(this).val());
    });
   
    console.log(arr);
 //   console.log(bill_quantity1);
    $.ajax({
        url: '{{URL::to('/save-billing-actually')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {arrayservice: arr, id_billing:id},
        dataType: 'json',
        success: function (response) 
        {
           alert(response['mes']);
            console.log(response);
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên dịch vụ</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th> Tổng</th>
                <th style="width:30px;"></th>
                <th>
                <button type="button" onClick="list_service1()" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus"> </i></button>
                </th>
            </tr>`;
            $('tbody').html('');
            response.service.forEach(function (item) {
              //  console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p><i><img src="{{asset ('backend/icon/detail appointment schedule.svg')}}"></i> ${item.service}</p>
                </td>
                <td class="project-title">
                    <p>${item.price}</p>
                </td>
                <td class="project-title">
                    <input  style="width:40px;" type="number" id="${item.id_service}_quanlity" onChange="update_quanlity(${item.id_service},${item.id_billing})" min="1" value="${item.billing_quantity}" >
                </td>
                
                <td class="project-title" id="${item.id_service}_billing_price">
                    <p>${formatNumber(item.billing_price)} VND</p>
                </td>
                <td >
                    <button type="button" class="btn btn-success btn-sm" onClick="remove_service(${item.id_service},${item.id_billing})"> Hủy </button>
                </td>
              
            </tr>
            `;    
            });//total_biliing
            output+=`
            <tr id="total_actually"> <td style="width:30px;"></td><td colspan="3"><strong style="color:green"> Tổng phát sinh :</strong></td>
            <td colspan="2"><strong style="color:green"> ${formatNumber(response.total[0].total_actually)} VND </strong></td></tr>`;
            $('tbody').html(output); 

            $('#total_billing').html(''); 
            var output_total=` <center> <h2> <strong style="color:green;"><i class="fa fa-glyphicon glyphicon-euro"></i> ${formatNumber(response.total_biliing)} VND </strong> </h2>`;
            $('#total_billing').html(output_total);

            
            
        }
    });
    }else{}
}
function remove_service(id_service,id_billing)
{
    var r = confirm('Bạn có muốn hủy dịch vụ phát sinh này không ?')
    if(r==true)
    {
    $.ajax({
        url: '{{URL::to('/remove-service-actually')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id_service: id_service, id_billing:id_billing},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th> Tên dịch vụ</th>
                <th> Đơn giá </th>
                <th> Số lượng</th>
                <th> Tổng </th>
                <th style="width:30px;"></th>
                <th>
                <button type="button" onClick="list_service1()" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus"></i></button>
                </th>
            </tr>`;
            $('tbody').html('');
            response.service.forEach(function (item) {
               // console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p><i><img src="{{asset ('backend/icon/detail appointment schedule.svg')}}"></i> ${item.service}</p>
                </td>
                <td class="project-title">
                    <p>${item.price}</p>
                </td>
                <td class="project-title">
                    <input  style="width:40px;" type="number" id="${item.id_service}_quanlity" onChange="update_quanlity(${item.id_service},${item.id_billing})" min="1" value="${item.billing_quantity}" >
                </td>
                <td class="project-title" id="${item.id_service}_billing_price">
                    <p>${formatNumber(item.billing_price)} VND</p>
                </td>
                <td >
                    <button type="button" class="btn btn-success btn-sm" onClick="remove_service(${item.id_service},${item.id_billing})"> Hủy </button>
                </td>
                
              
            </tr>
            `;    
            });

            $('#total_billing').html(''); 
            var output_total=` <center> <h2> <strong style="color:green;"><i class="fa fa-glyphicon glyphicon-euro"></i> ${formatNumber(response.total_biliing)} VND </strong> </h2>`;
            $('#total_billing').html(output_total);
            
            if(response.total != '')
            output+=`
            <tr id="total_actually"><td style="width:30px;"></td><td colspan="3"><strong style="color:green"> Tổng phát sinh:</strong></td>
            <td colspan="2"><strong style="color:green"> ${formatNumber(response.total[0].total_actually)} VND</strong></td></tr>`;
            $('tbody').html(output); 

            
        } 
    });
    alert('Hủy dịch vụ phát sinh thành công');
    }else{}
}
$( document ).ready(function() {
    $('#insert_img_result').on('submit', function(event) {
        event.preventDefault();
      
        $.ajax({
            url: '{{URL::to('/save-billing-document')}}',
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
            var output =``;
            response['data'].forEach(function (item) {
                console.log(item);
            output+=`
            <div>
            <button onClick="remove_img_document(${item.id})"><i class="fa fa-remove"></i></button>
            

            <a target="_blank" href="../../${item.image_upload}" class="imgpreview">
            <img src="../../${item.image_upload}" alt="gallery thumbnail" height="200" width="270" /></a>
             <div class="hr-line-dashed"></div>
            </div>
             `;
            });
           
            $('#show_img').html(output);
            alert(response['mes']);
            }
        });
    });

    $('#insert_img_payment').on('submit', function(event) {
        event.preventDefault();
        var r = confirm('Hình ảnh thanh toán sau khi thêm chỉ được cập nhật ảnh mới, không thể xóa')
        if(r = true)
        {
        $.ajax({
            url: '{{URL::to('/save-img-payment')}}',
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                alert(response['mes']);
                var output =``;
                response['data'].forEach(function (item) {
                output+=`
                <div>
                 <div class="hr-line-dashed"></div> 
                <a target="_blank" href="{{ asset('${item.payment_image}') }}" class="imgpreview">
                <img src="{{ asset('${item.payment_image}') }}" alt="gallery thumbnail" height="200" width="270" /></a>
                
                </div>`;  
                });
                $('#show_img_payment').html('');
                $('#show_img_payment').html(output);
            }
            
        });
    }else{ }

    });

});

function remove_img_document(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
    var id_billing = $('#id_billing').val();
    console.log(id);
    $.ajax({
        url: '{{URL::to('/remove-img-document')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id: id, id_billing:id_billing},
        dataType: 'json',
        success: function (response) 
        {
        alert(response['mes']);
        var output =``;
        response['data'].forEach(function (item) {
            console.log(item);
        output+=`
        <div>
        <button onClick="remove_img_document(${item.id})"><i class="fa fa-remove"></i></button>
        <a target="_blank" href="../../${item.image_upload}" class="imgpreview">
        <img src="../../${item.image_upload}" alt="gallery thumbnail" height="200" width="270" /></a>
        <div class="hr-line-dashed"></div>
        </div>
        `;
        });
    
        $('#show_img').html(output);
        }
    });
    }else{}
}
function update_quanlity(id_service, id_billing)
{
    //bliing_price
    var billing_quantity = $('#'+id_service+"_quanlity").val();
    $.ajax({
        url: '{{URL::to('/update-billing-quanlity')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {billing_quantity: billing_quantity, id_service:id_service, id_billing:id_billing},
        dataType: 'json',
        success: function (response) 
        {
            //console.log(response.total);

            $('#'+id_service+"_billing_price").html('');
            var output=`
            <p>${formatNumber(response.billing_price)} VND</p> `;
            $('#'+id_service+"_billing_price").html(output);

            $('#total_actually').html('');
            var total_actually=`
            <td style="width:30px;"></td><td colspan="3"><strong style="color:green"> Tổng phát sinh: </strong></td>
            <td colspan="2"><strong style="color:green"> ${formatNumber(response.total)} VND</strong></td>`;
            $('#total_actually').html(total_actually);
            
            $('#total_billing').html(''); 
            var output_total=` <center> <h2> <strong style="color:green;"><i class="fa fa-glyphicon glyphicon-euro"></i> ${formatNumber(response.total_biliing)} VND </strong> </h2>`;
            $('#total_billing').html(output_total); 
            
        }
    });
}

</script>
  
@endsection