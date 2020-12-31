@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2>Project list</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Apps</a>
                        </li>
                        <li class="active">
                            <strong>Project list</strong>
                        </li>
                    </ol>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox">
                <div class="inqbox-title">
                    <h5>All projects assigned to this account</h5>
                    <div class="inqbox-tools">
                        <button id="create_news" class="btn btn-primary btn-xs">Thêm bài viêt</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Mã đơn</th>
                                <th>Thời gian</th>
                                <th>Trạng thái đơn</th>
                                <th>Lọc :
                                <select  onChange="stt_billing()" id="stt">
                                <option value="6">Chọn</option>
                                <option value="1">Chờ xác nhận</option>
                                <option value="2">Đã đặt lịch</option>
                                <option value="3">Đã chuyển khoản</option>
                                <option value="4">Hoàn tất</option>
                                <option value="5">Đã hủy</option>
                                </select>

                                </th>
                                
                            </tr>
                            @foreach($all_bill as $key=> $v)
                            <tr>
                                <td style="width:30px;"></td>
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
                                <td> Hủy bỏ</td>
                                @endif

                                <td class="project-actions">
                                    <a  href="{{URL::to('/order-billing-detail')}}/{{$v->id}}"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết </a>
                                </td>
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
    </body>

<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
function stt_billing()
{
    var stt1 = $('#stt').val();
    console.log(stt1);
    $.ajax({
        url: '{{URL::to('/status-filter-billing')}}',
        type: 'GET',
        data: {billing_status: stt1 },
        dataType: 'json',
        success: function (response) 
        {
        var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Mã đơn</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Lọc :
                <select onChange="stt_billing()" id="stt">
                <option value="6">Chọn</option>
                <option value="1">Chờ xác nhận</option>
                <option value="2">Đã đặt lịch</option>
                <option value="3">Đã chuyển khoản</option>
                <option value="4">Hoàn tất</option>
                <option value="5">Đã hủy</option>
                </select>
                </th>  
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
            output+=`
             <tr>
                <td style="width:30px;"></td>
                <td>${item.billing_code}</td>
                <td>${item.billing_date}-${item.billing_time}</td>`;
                if(item.billing_status ==1)
            output+=`<td>Chờ xác nhận</td>`;
                else if (item.billing_status==2)
            output+=`<td>Đã đặt lịch</td>`;
                else if (item.billing_status==3)
            output+=`<td>Đã chuyển khoản</td>`;
                else if (item.billing_status==4)
            output+=`<td>Hoàn tất</td>`;
                else if (item.billing_status==5)
            output+=`<td>Đã hủy</td>`;
             output+=`
                <td class="project-actions">
                    <a href="{{URL::to('/order-billing-detail')}}/{{$v->id}}"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết </a>
                </td>
            </tr>
            `;
            });    
             $('tbody').html(output);   
        }
    }); 
}

</script>
@endsection
