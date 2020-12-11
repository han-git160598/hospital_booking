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
                        <button id="create_account_customer" class="btn btn-primary btn-xs">Thêm người dùng</button>
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
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Số dịch vụ</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($all_account_customer as $key=> $value)
                            <tr>
                                <td style="width:30px;"></td>
                                <td class="project-title">
                                    <p>{{$value->full_name}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{$value->phone_active}} VND</p> 
                                </td>
                                <td class="project-title">
                                    <p> {{$value->address}} VND</p> 
                                </td>
                                <td class="project-title">
                                    <p> {{$value->address}} VND</p> 
                                </td>
                                <td class="project-actions">
                                    <button onClick="history_account_customer({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>Lịch sử đơn</button>
                                    <button onClick="edit_account_customer({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                                    <button onClick="delete_account_customer({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
$("#create_account_customer").click( function(){
    
    var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label"><i><img src="{{asset ('backend/icon/vector.svg')}}"></i>SĐT đăng nhập</label>
        <div class="col-sm-10"><input type="text"  id="phone_active" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
        <label class="col-sm-2 control-label">Tên khách hàng(*):</label>
        <div class="col-sm-10"><input type="text"  id="full_name" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Ngày tháng năm sinh:</label>
        <div class="col-sm-10"><input type="date"  id="birthday" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Giới tính:</label>
        <div class="col-sm-10">
            <select class="btn btn-primary" id="sex">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
        </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Địa chỉ(*):</label>
        <div class="col-sm-10"><input type="text"  id="address" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Số điện thoại liên hệ :</label>
        <div class="col-sm-10"><input type="text"  id="phone_number" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-10"><input type="email"  id="email" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Mật khẩu(*) :</label>
        <div class="col-sm-10"><input type="text"  id="password" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        

        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_account_customer()"" type="btn" id="save_news">Thêm khách hàng</button>
        </div>
        </div>
    </div>
    </div> `;
    $('tbody').html(output);       
});
function save_account_customer()
{
    var phone_active1 = $('#phone_active').val()
    var full_name1 = $('#full_name').val();
    var birthday1 = $('#birthday').val();
    var sex1 = $('#sex').val();
    var address1 = $('#address').val();
    var phone_number1 = $('#phone_number').val();
    var email1 = $('#email').val();
    var password1 = $('#password').val();
    $.ajax({
        type:"GET",
        url:'{{URL::to('/save-account-customer')}}',
        data: {phone_active: phone_active1, full_name: full_name1, birthday: birthday1, sex:sex1, address :address1, phone_number:phone_number1, email:email1, password:password1
            },
        dataType:"json",
        success: function(response)
        {
            console.log(response);
            alert(response['mes']);
        }
    });
}
function delete_account_customer(id)
{
    console.log(id);
     $.ajax({
        type:"GET",
        url:'{{URL::to('/delete-account-customer')}}'+'/'+id,
        dataType:"json",
        success: function(response)
        {
        var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.full_name}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.phone_active} VND</p> 
                </td>
                <td class="project-title">
                    <p>${item.address} VND</p> 
                </td>

                <td class="project-actions">
                <button onClick="history_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i>Lịch sử đơn</button>
                    <button onClick="edit_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);
            
        }
    });
}
function edit_account_customer(id)
{
    console.log(id);
    $.ajax({
        type:"GET",
        url:'{{URL::to('/edit-account-customer')}}'+'/'+id,
        dataType:"json",
        success: function(response)
        {
        var output=``;
        $('tbody').html('');  
        output+=`
        <div class="inqbox-content">
        <div  class="form-horizontal">
            <div class="form-group">
            <label class="col-sm-2 control-label"><i><img src="{{asset ('backend/icon/vector.svg')}}"></i>SĐT đăng nhập</label>
            <div class="col-sm-10"><lable  class="form-control">${response[0].phone_active} </lable></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Tên khách hàng(*):</label>
            <div class="col-sm-10"><input type="text" value="${response[0].full_name}" id="full_name_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Ngày tháng năm sinh:</label>
            <div class="col-sm-10"><input type="date" value="${response[0].birthday}"  id="birthday_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Giới tính:</label>
            <div class="col-sm-10">
                <select class="btn btn-primary" id="sex_ud">
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                </select>
            </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Địa chỉ(*):</label>
            <div class="col-sm-10"><input type="text" value="${response[0].address}"  id="address_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Số điện thoại liên hệ :</label>
            <div class="col-sm-10"><input type="text" value="${response[0].phone_number}"  id="phone_number_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10"><input type="email" value="${response[0].email}"  id="email_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Mật khẩu(*) :</label>
            <div class="col-sm-10"><input type="text" value="${response[0].password}"  id="password_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            

            <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-primary" onClick="update_account_customer(${response[0].id})"" type="btn" id="update_account_customer">cập nhật</button>
            </div>
            </div>
        </div>
        </div> `;
        $('tbody').html(output); 
        }
    });
}
function update_account_customer(id)
{
    console.log(id);
    var full_name1 = $('#full_name_ud').val();
    var birthday1 = $('#birthday_ud').val();
    var sex1 = $('#sex_ud').val();
    var address1 = $('#address_ud').val();
    var phone_number1 = $('#phone_number_ud').val();
    var email1 = $('#email_ud').val();
    var password1 = $('#password_ud').val();
    console.log(id);
    $.ajax({
        type:"GET",
        url:'{{URL::to('/update-account-customer')}}'+'/'+id,
        data: {full_name: full_name1, birthday: birthday1, sex:sex1, address :address1, phone_number:phone_number1, email:email1, password:password1
            },
        dataType:"json",
        success: function(response)
        {
            alert(response['mes']);
        }
    });
}
function history_account_customer(id)
{
    $.ajax({
        type:"GET",
        url:'{{URL::to('/history-account-customer')}}'+'/'+id,
        dataType:"json",
        success: function(response)
        {
            console.log(response);
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Số dịch vụ sử dụng</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                //console.log(item.id);
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.billing_code}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.billing_date} - ${item.billing_time}</p>
                </td>
                <td class="project-title">
                    <p>5</p> 
                </td>

                <td class="project-actions">
                    <a href="{{URL::to('/detail-order-customer')}}/${item.id}" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết </a>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });
}

</script>
@endsection
