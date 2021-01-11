@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2>Tài khoản nhân viên</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Apps</a>
                        </li>
                        <li class="active">
                            <strong>Tài khoản nhân viên</strong>
                        </li>
                    </ol>
                </div>
                </div>
            </div>
        </div>

         {{--  ////////////////////////danh sách quyền/////////////////////////  --}}

        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Danh sách dịch vụ</h4>
              </div>
              <div class="modal-body">
               <form method="post" id="insert_form">
           
               <div id="permission">    
               
               </div>
          
                
               </form>
              </div>
              <div class="modal-footer">
               
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
             </div>
            </div>
        </div>
            {{--  ////////////////////////model/////////////////////////  --}}
          
        <div id="detail">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox">
                <div class="inqbox-title">
                    <h5>All projects assigned to this account</h5>
                    <div class="inqbox-tools">
                        <button id="create_account_admin" class="btn btn-primary btn-xs">Thêm người dùng</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" onkeyup="search_account_admin()" id="search_account_admin" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Họ & Tên</th>
                                <th>Số điện thoại</th>
                                <th>Chức vụ</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($data as $key=> $value)
                            <tr>
                            @if($value->status == 'Y')
                                <td class="project-status">
                                    <button id="status_account" class="label label-primary" onClick="disable_account_admin({{$value->id}})" >Disable</button>
                                </td>
                            @else
                                <td class="project-status">
                                    <button id="status_account" class="label label-primary" onClick="enable_account_admin({{$value->id}})" >Enable</button>
                                </td>
                            @endif
                               
                                <td class="project-title">
                                    <p>{{$value->full_name}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{$value->phone_number}}</p> 
                                </td>
                                <td class="project-title">
                                    <p> {{$value->type_account}}</p> 
                                </td>
                              
                                <td class="project-actions">
                                    <button onClick="account_admin_detail({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                                    <button onClick="delete_account_admin({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
    </div>
    </body>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
function disable_account_admin(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/disable-account-admin')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Họ & Tên</th>
                <th>Số điện thoại</th>
                <th>Chức vụ</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
            //    console.log(item);
            output+=`
            <tr>`;
            if(item.status == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_account_admin(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_account_admin(${item.id})" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.full_name}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.phone_number} VND</p> 
                </td>
                <td class="project-title">
                    <p>${item.type_account}</p> 
                </td>
                <td class="project-actions">
                    <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                    <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
                
                
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });   
}
function enable_account_admin(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/enable-account-admin')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Họ & Tên</th>
                <th>Số điện thoại</th>
                <th>Chức vụ</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
         //      console.log(item);
            output+=`
            <tr>`;
            if(item.status == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_account_admin(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_account_admin(${item.id})" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.full_name}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.phone_number} VND</p> 
                </td>
                <td class="project-title">
                    <p>${item.type_account}</p> 
                </td>
                <td class="project-actions">
                    <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                    <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
                
                
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });       
}
var arr_author = [];
function account_admin_detail(id)
{ 
    
    //console.log(id);
$('.modal-footer').html('<button type="button" data-dismiss="modal"  onClick="add_permission('+id+')" class="btn btn-success">Thêm quyền</button>');
$.ajax({
    url: '{{URL::to('/account-admin-detail')}}'+'/'+id,
    type: 'GET',
    dataType: 'json',
    success: function (response) 
    {
        console.log(response);
        var output=``;
        $('#detail').html(''); 
        response.forEach(function (item) {
           // console.log(item);                          
        output+=`
        <dialog id="confirm_password">
            <form method="dialog">
                <p><label>Mật khẩu:
                </label></p>
                
                Bạn có muốn xóa không
                </label></p>
                 <menu>
                <button>Hủy</button>
                <button onClick="remove_authorize(id_pre,id_admin)">Xác nhận</button>
                </menu>
            </form>
            </dialog>

            <dialog id="favDialog">
            <form method="dialog">
                <p><label>Mật khẩu:
                </label></p>
                <input type="password" minlength="6"  id="pass_admin">
                <p><label>Nhập lại mật khẩu:
                </label></p>
                <input type="password" minlength="6"  id="pass_admin_again">
                <p><label>
                <smal id="erro_pass"></smal>
                </label></p>
                 <menu>
                <button>Hủy</button>
                <button onClick="update_password_admin(${item[0].id})">Xác nhận</button>
                </menu>
            </form>
            </dialog>

        


        <div class="row">
            <div class="col-lg-9">
                <div class="animated fadeInUp">
                <div class="inqbox">
                    <div class="inqbox-content">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="m-b-md">
                                <button onClick="update_account_admin(${item[0].id})" class="btn btn-white btn-xs pull-right">Cập nhật</button>
                                <h2>Thông tin nhân viên</h2>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Trạng thái:</dt>`;
                            if (item[0].status=='Y')
                            output+=`
                                <dd>
                                Đang kích hoạt
                                </dd>`;
                            else
                            output+=`
                                <dd>
                                Đã tạm khóa
                                </dd>`;
                            output+=`
                            </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                            <dl class="dl-horizontal" >
                                <dt>Họ & Tên:</dt>
                                <dd><input value="${item[0].full_name}" type="text" id="full_name_admin_ud"></dd>
                                <dt>Số điện thoại</dt>
                                <dd><input value="${item[0].phone_number}" type="text" id="phone_number_ud"></dd>
                                <dt>Tên đăng nhập:</dt>
                                <dd><input value="${item[0].username}" type="text" id="username_admin_ud"></dd>
                                <dt>Email:</dt>
                                <dd><input value="${item[0].email}" type="text" id="email_admin_ud"></dd>
                            </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >
                                <dt>Loại tài khoản :</dt>
                                <dd>
                                ${item[0].type_account}
                                </dd>
                                <dt>Chọn lại :</dt>
                                <dd>
                                <select id="account_type">
                                <option value="0" >Chọn</option>`;
                                item[2].forEach(function (va) {
                                output+=`
                                <option value="${va.id}">${va.type_account}</option>`;
                                });
                                output+=`
                                </select></dd>
                                <dt></dt>
                                <dd><button onClick="resetpass_admin(${item[0].id})" type="button" class="btn btn-sm btn-primary">Đặt lại mật khẩu</button>
                                
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
                                        <li class="active"></li>
                                        </ul>
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
                <h2>Phân Quyền</h2>`;
                output+=`   <div id="list_premission">`;
              // console.log(item[1]);
                //console.log(item[0]);
                item[1].forEach(function (v) {

                output+=`
                <p><span><button onClick="popup_remove_authorize(${v.id},${item[0].id})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${v.description}</span></p>
                `;
                arr_author.push(v.id);
                });
                
                output+=`  </div>`;
                output+=`
                <div class="text-center m-t-md">
                    <a onClick="list_permission(${item[0].id})" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Thêm quyền</a>
                </div>
                </div>
            </div>
        </div> `;
        });
        $('#detail').html(output); 
    }

    });
}

function list_permission(id)
{
  console.log(arr_author);
  
  $.ajax({
    url: '{{URL::to('/list-account-permission')}}',
    type: 'GET',
    dataType: 'json',
    data: {id:id, arr_author1:arr_author},
    success: function (response) 
    {
       console.log(response)
    var output=`
    <tr> 
        <th style="width:30px;"></th>
        <th>Chọn :</th>
        <th style="width:50px;"></th>
        <th style="width:30px;"></th>
    </tr>`;
    $('#permission').html('');
    response.forEach(function (item) {
        //console.log(item);

    output+=`
    <tr>
        <td style="width:30px;"></td>
        <td class="project-title">
            <p>${item.description}</p>  
        </td>
        <td><input type="checkbox" value="${item.id}" id="${item.id}"></td>
        <td style="width:30px;"></td>
    </tr>`;    
    });
    $('#permission').html(output);    
    }
  });
}
function add_permission(id)
{
    console.log(id);
    var arr=[];
    $(':checkbox:checked').each(function(i){
       arr.push($(this).val());
    });
   // console.log(arr);
    $.ajax({
    url: '{{URL::to('/save-account-authorize')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {arr1:arr , id_acc_admin:id},
    dataType: 'json',
    success: function (response) 
    {
        output=``;
        $('#list_premission').html('');
        response.forEach(function (item) {
        output+=`
        <p><span><button onClick="popup_remove_authorize(${item.id},${item.id_admin})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${item.description}</span></p>
        `;
        });   
        $('#list_premission').html(output);    }
    });
}
/// dat mat khau

function resetpass_admin(id)
{
    console.log(id);
    favDialog.showModal(id);
}
function update_password_admin(id)
{
    $('#erro_pass').html('');
    var pass_admin1= $('#pass_admin').val();
    var pass_admin_again1= $('#pass_admin_again').val();
    if(pass_admin_again1 !=pass_admin1){
    $('#erro_pass').html('Mật khẩu không trùng khớp');
    }else{
        $.ajax({
        url: '{{URL::to('/reset-password-admin')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {pass_admin:pass_admin1 , id_admin:id},
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);    

        }
        });   
       
    }
}
function update_account_admin(id)
{
    var full_name = $('#full_name_admin_ud').val();
    var username = $('#username_admin_ud').val(); 
    var email= $('#email_admin_ud').val();
    var account_type= $('#account_type').val();
    var phone_number= $('#phone_number_ud').val();
    console.log(account_type);
    $.ajax({
        url: '{{URL::to('/update-account-admin')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id:id, full_name:full_name , username:username, email:email, account_type:account_type, phone_number:phone_number },
        dataType: 'json',
        success: function (response) 
        {
        alert(response['mes']);    
        }
    });
    
}
function popup_remove_authorize(id_pre,id_admin)
{
    
    console.log(id_pre);console.log(id_admin);
    confirm_password.showModal();
}

function remove_authorize(id_pre,id_admin)
{
    console.log(id_pre);console.log(id_admin);
$.ajax({
    url: '{{URL::to('/remove-authorize-admin')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {id_pre1:id_pre , id_admin1:id_admin},
    dataType: 'json',
    success: function (response) 
    {
        console.log(response);
        output=``;
        $('#list_premission').html('');
        response.forEach(function (item) {
        output+=`
        <p><span><button onClick="remove_authorize(${item.id},${item.id_admin})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${item.description}</span></p>
        `;
        });   
        $('#list_premission').html(output); 
    }
    });
     location.reload();
    
}
$('#create_account_admin').click(function(){
    var output=``;
    $('#detail').html(''); 
    $.ajax({
    url: '{{URL::to('/list-account-type')}}',
    type: 'GET',
    dataType: 'json',
    success: function (response) 
    {
        console.log(response);
    output+=` 
    <div class="row">
        <div class="col-lg-9">
            <div class="animated fadeInUp">
            <div class="inqbox">
                <div class="inqbox-content">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="m-b-md">
                            <button onClick="save_account_admin()"  class="btn btn-white btn-xs pull-right"> Lưu </button>
                            <h2>Thông tin nhân viên</h2>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>Trạng thái:</dt>
                            <dd>
                            active
                            </dd>
                        </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                        <dl class="dl-horizontal" >
                            <dt>Họ & Tên:</dt>
                            <dd><input  type="text" id="full_name_admin"></dd>
                            <dt>Tên đăng nhập:</dt>
                            <dd><input type="text" id="username_admin"></dd>
                            <dt>Số điện thoại:</dt>
                            <dd>
                            <input type="text" id="phone_number" >
                            </dd>
                        </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                        <dl class="dl-horizontal" >
                            
                            <dt>Email:</dt>
                            <dd><input type="email" id="email_admin"></dd>
                            <dt>Mật khẩu:</dt>
                            <dd>
                            <input type="password" id="password_admin" >
                            </dd>
                            <dt>Loại tài khoản :</dt>
                            <dd>
                            <select id="account_type1">
                            <option >Chọn</option>`;
                            console.log(response[1]);
                            response[1].forEach(function (item) {
                                console.log(item);
                            output+=`
                            <option value="${item.id}">${item.type_account}</option>`;
                            });
                            output+=`
                            </select></dd>
                        </dl>
                        </div>
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs tab-border-top-danger">
                                    <li class="active"></li>
                                    </ul>
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
            <h3><a  class="btn btn-warning">Chọn quyền</a></h3>
            
        <div>`;
        response[0].forEach(function (item) {
        output+=`                    
            <p><span>
            
            <input type="checkbox" value="${item.id}" > ${item.description}</span></p>`;
        });
        output+=`
        </div>
            
            <div class="text-center m-t-md">
                <a href="#" class="btn btn-xs btn-primary">Add files</a>
                <a href="#" class="btn btn-xs btn-primary">Report contact</a>
            </div>
            </div>
        </div>
    </div> `;
     $('#detail').html(output); 
    }
    });
});
function save_account_admin()
{
    var full_name1 = $('#full_name_admin').val();
    var username1 = $('#username_admin').val(); 
    var email1= $('#email_admin').val();
    var account_type1= $('#account_type1').val();
    var password_admin1= $('#password_admin').val();
    var phone_number1= $('#phone_number').val();
    var arr_permission1=[];
        $(':checkbox:checked').each(function(i){
        arr_permission1.push($(this).val());
        });
        console.log(arr_permission1);
    $.ajax({
    url: '{{URL::to('/save-account-admin')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {phone_number:phone_number1, full_name:full_name1, email:email1, username:username1
            ,password_admin:password_admin1, account_type:account_type1, arr_per1:arr_permission1},
    dataType: 'json',
    success: function (response) 
    {
       // console.log(response);
       alert(response['mes']);
    }
    });
}

function delete_account_admin(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
    $.ajax({
    url: '{{URL::to('/delete-account-admin')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {id:id},
    dataType: 'json',
    success: function (response) 
    {
        output=`
        <tr> 
            <th style="width:30px;"></th>
            <th>Họ & Tên</th>
            <th>Số điện thoại</th>
            <th>Chức vụ</th>
            <th style="width:30px;"></th>
        </tr>`;
        $('tbody').html('');
        response.forEach(function (item) {
        output+=`
        <tr>`;
        if(item.status == 'Y')
        output+=`
            <td class="project-status">
                <button id="status_account" class="label label-primary" onClick="disable_account_admin(${item.id})" >Disable</button>
            </td>`;
        else
        output+=`
            <td class="project-status">
                <button id="status_account" class="label label-primary" onClick="enable_account_admin(${item.id})" >Enable</button>
            </td>`;
        output+=`
        <td class="project-title">
            <p>${item.full_name}</p>  
        </td>
        <td class="project-title">
            <p> ${item.phone_number}</p> 
        </td>
        <td class="project-title">
            <p> ${item.type_account}</p> 
        </td>
      
        <td class="project-actions">
            <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
            <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
        </td>
        </tr>`;

        });
      $('tbody').html(output);
    }
    });
    }else{
        
    }
}
function search_account_admin()
{
   
     setInterval(function() {
       

    var result = $('#search_account_admin').val();
     $.ajax({
        url: '{{URL::to('/search-account-admin')}}',
        type: 'POST',
        data: {result:result},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Họ & Tên</th>
                <th>Số điện thoại</th>
                <th>Chức vụ</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
            output+=`
            <tr>`;
            if(item.status == 'Y')
            output+=`
                <td class="project-status">
                    <button id="status_account" class="label label-primary" onClick="disable_account_admin(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`
                <td class="project-status">
                    <button id="status_account" class="label label-primary" onClick="enable_account_admin(${item.id})" >Enable</button>
                </td>`;
            output+=`
            <td class="project-title">
                <p>${item.full_name}</p>  
            </td>
            <td class="project-title">
                <p> ${item.phone_number}</p> 
            </td>
            <td class="project-title">
                <p> ${item.type_account}</p> 
            </td>
        
            <td class="project-actions">
                <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
            </td>
            </tr>`;

            });
        $('tbody').html(output);
        }
     });
       }, 500); //5 seconds
         
}
</script>
@endsection
