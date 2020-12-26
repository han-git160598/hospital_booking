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

         {{--  ////////////////////////danh sách dịch vụ/////////////////////////  --}}

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
                    <button onClick="delete_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
                    <button onClick="edit_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_account_customer(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
                
                
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });       
}
function account_admin_detail(id)
{ 
    //console.log(id);
    $('.modal-footer').html('<button type="button" data-dismiss="modal"  onClick="add_permission('+id+')" class="btn btn-success">Thêm dịch vụ</button>');
$.ajax({
    url: '{{URL::to('/account-admin-detail')}}'+'/'+id,
    type: 'GET',
    dataType: 'json',
    success: function (response) 
    {
        var output=``;
        $('#detail').html(''); 
        response.forEach(function (item) {
        output+=`
       
           
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
                <button type="button" onClick="update_password_admin(${item.id})">Xác nhận</button>
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
                                <button onClick="update_account_admin(${item.id})" class="btn btn-white btn-xs pull-right">Cập nhật</button>
                                <h2>Thông tin nhân viên</h2>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Trạng thái:</dt>
                                <dd><span class="label label-primary">Active</span></dd>
                            </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                            <dl class="dl-horizontal" >
                                <dt>Họ & Tên:</dt>
                                <dd><input value="${item.full_name}" type="text" id="full_name_admin_ud"></dd>
                                <dt>Tên đăng nhập:</dt>
                                <dd><input value="${item.username}" type="text" id="username_admin_ud"></dd>
                                <dt>Email:</dt>
                                <dd><input value="${item.email}" type="text" id="email_admin_ud"></dd>
                            </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >
                                <dt>Loại tài khoản :</dt>
                                <dd><select>
                                <option id="account_type">Chọn</option>
                                <option value="1">Quản lý nhân viên</option>
                                <option value="2">Quản lý khách hàng</option>
                                </select></dd>
                                <dt></dt>
                                <dd><button onClick="resetpass_admin(${item.id})" type="button" class="btn btn-sm btn-primary">Đặt lại mật khẩu</button>
                                
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
                                        <li class="active"><a onClick="list_permission()" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Phân Quyền<img src="{{asset ('backend/icon/add.svg')}}"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-1">
                                        <div class="feed-activity-list">
                                            <div class="feed-element">
                                                <div class="media-body ">
                                                    <strong>${item.description}</strong> posted message on <strong>Monica Mendoza</strong> site. <br>
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
                <img src="#" class="img-responsive">
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
        </div> `;
        });
        $('#detail').html(output); 
    }
    });
}
function list_permission()
{
  //console.log(id);  
  $.ajax({
    url: '{{URL::to('/list-account-permission')}}',
    type: 'GET',
    dataType: 'json',
    success: function (response) 
    {
       // console.log(response)
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
    //console.log(arr);
    $.ajax({
    url: '{{URL::to('/save-account-authorize')}}',
    type: 'POST',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {arr1:arr , id_acc_admin:id},
    dataType: 'json',
    success: function (response) 
    {
        console.log(response);
    }
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
        //favDialog.closedModal();
    }
}
function update_account_admin(id)
{
    var full_name = $('#full_name_admin_ud').val();
    var username = $('#username_admin_ud').val(); 
    var email= $('#email_admin_ud').val();
    var account_type= $('#account_type').val();
    console.log(account_type);
}
</script>
@endsection
