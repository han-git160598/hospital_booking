@extends('dashboard')
@section('admin_content') 

<div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> LỊCH SỬ ĐƠN KHÁM </h2>
                  
                </div>
                </div>
            </div>
        </div>

        <div class="row"> 
            <div class="col-sm-8">
                <div class="inqbox">
                <div class="inqbox-content">
                    <a href="{{URL::to('/all-account-customer')}}" class="text-muted small pull-right"> 
                    <button type="button" class="btn btn-primary btn-sm btn-block"> Trở về </button></a>

                    <div class="clients-list">
                         @foreach($data['billing'] as $v)
                        <ul class="nav nav-tabs tab-border-top-danger">
                       
                            <li class="active"><a data-toggle="tab" href="#tab-1" onClick="billing_detail({{$v->id}})">Thông tin bill</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="customer_detail({{$v->id}})">Khách hàng</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="service_detail({{$v->id}})">Dịch vụ</a></li>
                            <li class=""><a data-toggle="tab" href="#" onClick="actually_detail({{$v->id}})">Phát sinh</a></li>
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
                                           
                                            
                                        </tr>
                                
                                       @foreach($data['billing'] as $v)
                                        <tr>
                                            <td>{{$v->billing_code}}</td>
                                            <td>{{$v->billing_date}}-{{$v->billing_time}}</td>

                                            @if($v->billing_status ==1)
                                            <td>Chờ xác nhận</td>
                                            @elseif ($v->billing_status==2)
                                            <td>Lên kế hoạch</td>
                                            @elseif ($v->billing_status==3)
                                            <td>Chuyển nhượng</td>
                                            @elseif ($v->billing_status==4)
                                            <td>Hoàn tất</td>
                                            @else
                                            <td>Hủy bỏ</td>
                                            @endif

                                           
                                        </tr>
                                        @endforeach
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
                           
                            <div >  
                              <center>  <h1 ><strong> Kết quả </strong> </h1>  </center>
                              
                            </div>
                           
                            <div class="col-lg-12">
                           
                            
                            <center> <h3> <strong style="color:blue;">  </strong> </h3> 
                            
                            <div>
                            @if(isset($data['document']))
                            @foreach($data['document'] as $v )
                             <center> <img src="{{ asset($v->image_upload) }}" alt="" height="150" width="150"> </center>
                             @endforeach
                            @else
                            
                            @endif
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
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>   
function service_detail(id)
{
   // console.log(id);
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
                <th>Giá</th>
                <th style="width:30px;"></th>   
            </tr>`;
            $('tbody').html('');
            var sum =0 ;
            response.forEach(function (item) {
                console.log(item);
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
            sum +=parseInt(item.price);
            });
             output+=`
            <tr> <td style="width:30px;"></td><td>Tổng tiền:</td>
            <td></td>
            <td>${sum}</td></tr>`;
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
        url: '{{URL::to('/actually-detail')}}',
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
                <th>Tên dịch vụ</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.service.forEach(function (item) {
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
            output+=`
            <tr> <td style="width:30px;"></td><td>Tổng tiền:</td>
            <td></td><td></td>
            <td>${response.total[0].total_actually}</td></tr>`;

            $('tbody').html(output); 
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
                    <p>${item.billing_code}<p>
                </td>
                <td class="project-title">
                    <p>${item.billing_date}-${item.billing_time}<p>
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
                <td style="width:30px;"></td>
                
            </tr>`;    
            });
            $('tbody').html(output); 
        }
    });
}
</script>
  
@endsection