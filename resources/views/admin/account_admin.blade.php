@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height:63px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> Tài khoản nhân viên </h2>
                   
                </div>
                </div>
            </div>
        </div>
        {{--  dialog thanh cong reset pass word  --}}
        <dialog id="alert_resset_pass"> 
        <form method="dialog">
            <h3><strong> Thay đổi mật khẩu thành công </strong></h2>
            <center>  <button class="btn btn-success btn-sm"> OK </button> </center>
        </form>
        </dialog>

         {{--  ////////////////////////danh sách quyền/////////////////////////  --}}

        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title"> Danh sách quyền hạn </h4>
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
                    <h5></h5>
                    <div class="inqbox-tools">
                        <button id="create_account_admin" class="btn btn-primary btn-xs">Thêm người dùng</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" onkeyup="search_account_admin()" id="search_account_admin" placeholder="Tìm kiếm" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> </button> </span>
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
                                </td><td>   
                                    <button onClick="delete_account_admin({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
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
                    <p> ${item.phone_number}</p> 
                </td>
                <td class="project-title">
                    <p>${item.type_account}</p> 
                </td>
                <td class="project-actions">
                    <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                </td><td >   
                    <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
                
                
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });   
}
function enable_account_admin(id)
{

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
                    <p> ${item.phone_number} </p> 
                </td>
                <td class="project-title">
                    <p>${item.type_account}</p> 
                </td>
                <td class="project-actions">
                    <button onClick="account_admin_detail(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Chi tiết</button>
                </td><td >   
                    <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
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
                <button>Hủy </button>
                <button onClick="remove_authorize(id_pre,id_admin)">Xác nhận</button>
                </menu>
            </form>
            </dialog>

            <dialog id="reset_password">
            <form method="dialog">
                <p><label>Mật khẩu:</label></p>
                <input type="password"id="pass_admin" name="pass_admin"> <a type="button" onclick="show_password1()" href="#"><i class="fa fa-eye"></i></a>
                <p><label>Nhập lại mật khẩu:</label></p>
                <input type="password" id="pass_admin_again" name="pass_admin_again"><a type="button" onclick="show_password2()" href="#"><i class="fa fa-eye"></i></a>
                <p><label><smal id="erro_pass"></smal></label></p>
                <br/>
                <menu>
                <button type="submit" >Hủy </button>
                <button type="submit" onClick="update_password_admin(${item[0].id})"> Xác nhận </button>
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
                                <button onClick="update_account_admin(${item[0].id})" class="btn btn-sm  btn-primary pull-right">Cập nhật</button>
                                <a href="{{URL::to('all-account-admin')}}"><button class="btn btn-sm btn-primary"> Trở về </button></a>
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
                                <dt>Họ & Tên(*):</dt>
                                <dd><input value="${item[0].full_name}"  type="text" id="full_name_admin_ud"></dd>
                                <dt>Số điện thoại(*):</dt>
                                <dd><input value="${item[0].phone_number}" type="text" onkeypress='return event.charCode >= 47 && event.charCode <= 57' id="phone_number_ud"></dd>
                                <dt>Tên đăng nhập(*):</dt>
                                <dd><input type="text" value="${item[0].username}" readonly  id="username_admin_ud"></dd>
                                <dt>Email:</dt>
                                <dd><input value="${item[0].email}" type="email" id="email_admin_ud"></dd>
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
                <h1 ><strong> Phân quyền </strong></h1>`;
                output+=`   <div id="list_premission">`;
            
                item[1].forEach(function (v) {

                output+=`
                <p><span><button onClick="remove_authorize(${v.id},${item[0].id})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${v.description}</span></p>
                `;
                arr_author.push(v.id);
                });
                output+=`  </div>`;
                output+=`
                <div class="text-center m-t-md">
                    <a onClick="list_permission(${item[0].id})" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"> Danh sách </a>
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
  
  
  $.ajax({
    url: '{{URL::to('/list-account-permission')}}',
    type: 'GET',
    dataType: 'json',
    data: {id:id, arr_author1:arr_author},
    success: function (response) 
    {
       
    var output=`
    <tr> 
        <th style="width:80px;"></th>
        <th> Chọn :</th>
        <th style="width:30px;"></th>
        <th style="width:30px;"></th>
    </tr>`; 
    $('#permission').html('');
    response.forEach(function (item) {
      
    output+=`
    <tr>
        <td style="width:80px;"></td>
        <td class="project-title">
            <p>${item.description}</p>  
        </td>
        <td class="project-title">
        <p><input type="checkbox" value="${item.id}" id="${item.id}"></p>
        </td>
        <td style="width:30px;"></td>
    </tr>`;    
    });
    $('#permission').html(output);    
    }
  });
}

function add_permission(id)
{

    var arr=[];
    $(':checkbox:checked').each(function(i){
       arr.push($(this).val());
    });
  var arr_author2=[];
    $.ajax({
    url: '{{URL::to('/save-account-authorize')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {arr:arr , id:id},
    dataType: 'json',
    success: function (response) 
    {
       
        
        output=``;
        $('#list_premission').html('');
        response.forEach(function (item) {
        output+=`
        <p><span><button onClick="remove_authorize(${item.id},${item.id_admin})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${item.description}</span></p>
        `;
          arr_author2.push(item.id);
        });   
        arr_author=arr_author2;
        $('#list_premission').append(output); 
    }
    });
   // list_permission(id);
}
/// dat mat khau

function resetpass_admin(id)
{
    
    reset_password.showModal(id);
}
function update_password_admin(id)
{
    $('#erro_pass').html('');
    var pass_admin1= $('#pass_admin').val();
    var pass_admin_again1= $('#pass_admin_again').val();
    if(pass_admin1.indexOf(' ') >= 0)
    {
        alert('Mật khẩu không được thêm kí tự trắng');
        return;
    }
    if(pass_admin1 == '' || pass_admin_again1 =='')
    {
        alert('Vui lòng không bỏ trống');
        return;
    }
    if(pass_admin1.length < 6)
    {
        alert('Mật khẩu phải tối thiểu 6 kí tự');
        return;
    }
    if(pass_admin_again1 !=pass_admin1){
    $('#erro_pass').html('Mật khẩu không trùng khớp');
    alert(' Mật khẩu không trùng khớp');
    }
    else{
    $.ajax({
        url: '{{URL::to('/reset-password-admin')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {pass_admin:pass_admin1 , id_admin:id},
        dataType: 'json',
        success: function (response) 
        {
         
            alert(response['mes']);    
            if(response['mes']=='Thay đổi mật khẩu thành công !')
            {
                alert_resset_pass.showModal();
            }

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
    if(full_name=='' || username == '' || phone_number == '')
    {
        alert('Vui lòng điền đủ trường có kí hiệu (*) !');
        return ;
    }
    $.ajax({
        url: '{{URL::to('/update-account-admin')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id:id, full_name:full_name , username:username, email:email, account_type:account_type, phone_number:phone_number },
        dataType: 'json',
        success: function (response) 
        {
          //  console.log(response);
            alert(response['mes']);    
        }
    });
    
}
function popup_remove_authorize(id_pre,id_admin)
{
    
 
    confirm_password.showModal();
}

function remove_authorize(id_pre,id_admin)
{
    var arr_author2=[];
 
var r=confirm('Waring! Bạn có muốn xóa không !!');
if(r==true)
{
    $.ajax({
        url: '{{URL::to('/remove-authorize-admin')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id_pre1:id_pre , id_admin1:id_admin},
        dataType: 'json',
        success: function (response) 
        {
           
            output=``;
            $('#list_premission').html('');
            response.forEach(function (item) {
            output+=`
            <p><span><button onClick="remove_authorize(${item.id},${item.id_admin})" class="label label-primary" ><i class="fa fa-remove"></i></button> ${item.description}</span></p>
            `;
            arr_author2.push(item.id);
            });   
            arr_author=arr_author2;
            $('#list_premission').html(output); 
        }
        });
        alert('Xóa quyền thành công')
    }else{  }
  //list_permission(id_admin); 
}
$('#create_account_admin').click(function(){
   //  document.getElementById("form_admin").reset();
    // $("#form_admin").reset();
    var output=``;
    $('#detail').html(''); 
    $.ajax({
    url: '{{URL::to('/list-account-type')}}',
    type: 'GET',    
    dataType: 'json',
    success: function (response) 
    {
   
    output+=` 
    <div class="row">
        <div class="col-lg-9">
            <div class="animated fadeInUp">
            <div class="inqbox">
                <div class="inqbox-content">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="m-b-md">
                            <button onClick="save_account_admin()" class="btn btn-sm btn-primary pull-right"> Thêm tài khoản </button>
                            <a href="{{URL::to('all-account-admin')}}"><button class="btn btn-sm btn-primary"> Trở về </button></a>
                            <h2>Thông tin nhân viên</h2>
                        </div>
                        
                        </div>
                    </div>
                    <form id="form_admin">
                    <div class="row">
                        <div class="col-lg-5">
                        <dl class="dl-horizontal" >
                            <dt>Họ & Tên(*):</dt>
                            <dd><input  type="text" id="full_name_admin"></dd>
                            <dt>Tên đăng nhập(*):</dt>
                            <dd><input type="text" id="username_admin"></dd>
                            <dt>Số điện thoại(*):</dt>
                            <dd>
                            <input type="text" onkeypress='return event.charCode >= 47 && event.charCode <= 57' id="phone_number" >
                            </dd>
                        </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                        <dl class="dl-horizontal" >
                            
                            <dt>Email:</dt>
                            <dd><input type="email" id="email_admin"></dd>
                            <dt>Mật khẩu(*):</dt>
                            <dd>
                            <input type="password" id="password_admin" >
                            </dd>
                            <dt>Loại tài khoản(*) :</dt>
                            <dd>
                            <select id="account_type1">
                            <option value="0">Chọn</option>`;
                       
                            response[1].forEach(function (item) {
                             
                            output+=`
                            <option value="${item.id}">${item.type_account}</option>`;
                            });
                            output+=`
                            </select></dd>
                        </dl>
                        </div>
                    </div>
                    </form>
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
    //console.log(account_type1);
    var password_admin1= $('#password_admin').val();
    var phone_number1= $('#phone_number').val();
    var arr_permission1=[];
    $(':checkbox:checked').each(function(i){
    arr_permission1.push($(this).val());
    });

    if(account_type1 == 0 || full_name1=='' || username1 == '' || phone_number1 == '' || password_admin1=='' )
    {
        alert('Vui lòng điền đủ trường có kí hiệu (*) !');
        return ;
    }
    if( arr_permission1.length == 0)
    {
        alert('Bạn chưa chọn quyền cho tài khoản ');
        return ;
    }
    $.ajax({
    url: '{{URL::to('/save-account-admin')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {phone_number:phone_number1, full_name:full_name1, email:email1, username:username1
            ,password_admin:password_admin1, account_type:account_type1, arr_per1:arr_permission1},
    dataType: 'json',
    success: function (response) 
    {
        if(response['mes']=='Tạo tài khoản thành công !')
        {
        alert(response['mes']);
        $('#full_name_admin').val("");
        $('#username_admin').val(""); 
        $('#email_admin').val("");
        $('#password_admin').val("");
        $('#phone_number').val(""); 
        }else{
            alert(response['mes']);
        }
   
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
           </td><td >   
            <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
        </td>
        </tr>`;

        });
      $('tbody').html(output);
    }
    });
    alert('Xóa nhân viên thành công')
    }else{
        
    }
}
function search_account_admin()
{
   
   //  setInterval(function() {
       

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
              </td><td >   
                <button onClick="delete_account_admin(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
            </td>
            </tr>`;

            });
        $('tbody').html(output);
        }
     });
      // }, 500); //5 seconds
         
}



//// pass
        function show_password1(){
        var x = document.getElementById("pass_admin");
        if (x.type === "password" ) {x.type = "text";} else {x.type = "password";}
        }
        function show_password2(){
        var y = document.getElementById("pass_admin_again");
        if (y.type === "password" ) {y.type = "text";} else {y.type = "password";}
        }
            
           
</script>
@endsection
