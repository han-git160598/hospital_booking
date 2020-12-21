@extends('dashboard')
@section('admin_content') 

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
                    <h2> @if($data[0]->billing_type == 1)
                                <strong>Khám cá nhân</strong>
                            @else
                                <strong>Khám hộ</strong>
                            @endif
                    </h2>
              
                    <div class="input-group">
                        <input type="text" hidden value="{{$data[0]->id}}" id="id_bill">
                        <input type="text" placeholder="Search client " class="input form-control">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                    
                    <div class="clients-list">
                         @foreach($data as $v)
                        
                        <ul class="nav nav-tabs tab-border-top-danger">
                            <span class="pull-right small text-muted">1406 Elements</span>
                            <li class="active"><a data-toggle="tab" href="#tab-1" onClick="billing_detail({{$v->id}})">Thông tin bill</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="customer_detail({{$v->id}})">Khách hàng</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="service_detail({{$v->id}})">Dịch vụ</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="actually_detail({{$v->id}})">Phát sinh</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="appointment_detail({{$v->id}})">Tạo lịch trình</a></li>
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
                                            <th>Mã đơn hàng</th>
                                            <th>Thời gian hẹn </th>
                                            <th>Trạng thái</th>
                                            <th>Kết quả</th>   
                                        </tr>
                                       @foreach($data as $v)
                                        <tr>
                                            <td>{{$v->billing_code}}</td>
                                            <td id="date_time">{{$v->billing_date}} | {{$v->billing_time}}
                                            </td>
                                            @if($v->billing_status ==1)
                                            <td>Chờ xác nhận</td>
                                            @elseif ($v->billing_status==2)
                                            <td>Lên kế hoạch</td>
                                            @elseif ($v->billing_status==3)
                                            <td>Chuyển nhượng</td>
                                            @elseif ($v->billing_status==4)
                                            <td>Hoàn tất</td>
                                            @else
                                            <td> Hủy bỏ</td>
                                            @endif
                                            <td ><img alt="image" src="#"> </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    <!-- Simple pop-up dialog box containing a form -->
                                    <dialog id="favDialog">
                                    <form method="dialog">
                                        <tr><td>
                                        <label>Vui lòng nhập lý do hủy đơn !</label>
                                        </td></tr>
                                        <tr><td>
                                        <textarea id="bill_comment" rows="4" cols="50">
                                        </textarea>
                                        </td></tr>
                                        <menu>
                                        <button>Từ chối</button>
                                        <button onClick="cancel_order({{$data[0]->id}})">Hoàn thành</button>
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
      <button onClick="update_billing_date({{$data[0]->id}})">Xác nhận</button>
    </menu>
  </form>
</dialog>




                                    
                                    @if($v->billing_status==5)

                                    @else
                                    <h3 style="float:right;width:50%;""><center><tr>
                                    <td>
                                     <button id="edit_time"  class="btn btn-primary btn-sm"> Chọn lại thời gian</button>
                                    </td>
                                    
                                    <td>
                                    <button id="cancel_bill"  class="btn btn-primary btn-sm">Hủy đơn</button>
                                    </td>
                                    <td><button id="confirm_bill" class="btn btn-primary btn-sm" >Xác nhận</button></td>
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
            <div class="col-sm-4">
                <div class="inqbox ">
                <div class="inqbox-content">
                    <div class="tab-content">
                        <div id="contact-1" class="tab-pane active">
                            <div class="row m-b-lg">
                            <div class="col-lg-4 text-center">
                                <h2>Nicki Smith</h2>
                                <div class="m-b-sm">
                                    
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
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

<script>   
function service_detail(id)
{
   // console.log(id);
    $.ajax({
        url: '{{URL::to('/service-detail')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {   var dem = 1;
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>STT</th>
                <th>Dịch vụ</th>
                <th>Giá</th>
                <th style="width:30px;"></th>   
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                //console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${dem++}<p>
                </td>
                <td class="project-title">
                    <p>${item.service}<p>
                </td>
                <td class="project-title">
                    <p>${item.price}<p>
                </td>
                <td style="width:30px;"></td>
                
            </tr>`;    
            });
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
            //console.log(response);  
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
                //console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.customer_name}<p>
                </td>
                <td class="project-title">
                    <p>${item.customer_phone}<p>
                </td>
                <td class="project-title">
                    <p>${item.customer_address}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_date}<p>
                </td>
                <td class="project-title">
                    <p>${item.customer_sex}<p>
                </td>
                <td style="width:30px;"></td>    
            </tr>`;    
            });
            $('tbody').html(output); 
        }
    });
}
function actually_detail(id)
{
   // console.log(id);
     $.ajax({
        url: '{{URL::to('/actually-detail')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên dịch vụ</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                //console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.service}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_price}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_quantity}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_quantity}<p>
                </td>
           
                <td style="width:30px;"></td>
                
            </tr>`;    
            });
            $('tbody').html(output); 
        
        }
     });
}
function billing_detail(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/billing-detail')}}'+'/'+id,
        type: 'GET',
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
                <th>Kết quả</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
               console.log(item);
            output+=`
           <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.billing_code}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_date} | ${item.billing_time}<p>
                </td>`;
                 if(item.billing_status ==1)
            output+=`<td>Chờ xác nhận</td>`;
                else if (item.billing_status==2)
            output+=`<td>Lên kế hoạch</td>`;
                else if (item.billing_status==3)
            output+=`<td>Chuyển nhượng</td>`;
                else if (item.billing_status==4)
            output+=`<td>Hoàn tất</td>`;
                else
            output+=`<td>Hủy bỏ</td>`;
            output+=`
                <td class="project-title">
                    <p><img  src="${item.image_upload}"><p>
                </td>
                <td style="width:30px;"></td>
                
            </tr>`;     
            });
            $('tbody').html(output); 
        }
    });
}
var arrtime= [];
function appointment_detail(id)
{
    arrtime =[];
  //  console.log(arrtime)
    $.ajax({
        url: '{{URL::to('/service-detail')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
        var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Dịch vụ</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th style="width:30px;"></th>   
                <th style="width:30px;"></th>   
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                //console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.service}<p>
                </td>
                <form id="${item.id}reset">
                <td class="project-title">
                    <input type="time" id="${item.id}st">
                </td>
                <td class="project-title">
                    <input type="time" id="${item.id}ft">
                </td>
                <td><input type="button" onclick="resettime(${item.id})" value="Xóa"></td>
                </form>
                <td style="width:30px;"></td>
            </tr>
            `;    
            arrtime.push(item.id)
            });
         // console.log(arrtime);
            
            $('tbody').html(output);   
        }
    });
}

$('#confirm_bill').click(function(){
    var a = arrtime;
    var arrlich =[];
    console.log(a); 
    for (i = 0; i <a.length; i++){
    var starttime = $('#'+a[i]+"st").val();
    var finishtime = $('#'+a[i]+"ft").val();   
    var id_bill1 =  $('#id_bill').val();   
     console.log(id_bill1);
   //  console.log(starttime); 
   //  console.log(finishtime); 
     arrlich.push({"id":a[i],"starttime":starttime,"finishtime":finishtime});
    }
    console.log(arrlich);
    $.ajax({
        url: '{{URL::to('/add-appointment')}}',
        type: 'GET',
        data:{arrlich1:arrlich, id:id_bill1},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
           // alert(response['mes']);
        }
    });
    


});
function cancel_order(id)
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

  

}
/// huy don /////////////
(function() {
  var updateButton = document.getElementById('cancel_bill');
  var favDialog = document.getElementById('favDialog');

  // “Update details” button opens the <dialog> modally
  updateButton.addEventListener('click', function() {
    favDialog.showModal();
  });
})();
/// chon lai time ////////////

function update_billing_date(id)
{
    console.log(id);
    var date = $('#billing_date').val();
    var time = $('#billing_time').val();
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
                    <p>${item.billing_date} | ${item.billing_time} 
                    <p>
                </td>`;    
            });
            $('#date_time').html(output);   
        }
    });
    

}
(function() {
  var updateButton = document.getElementById('edit_time');
  var favDialog = document.getElementById('dialogtime');

  // “Update details” button opens the <dialog> modally
  updateButton.addEventListener('click', function() {
    favDialog.showModal();
  });
})();


</script>
  
@endsection