@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> QUYỀN HẠN </h2>
                    
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox">
                <div class="inqbox-title">
                    <h5></h5>
                    <div class="inqbox-tools">
                        <!-- <button id="create_account_permission" class="btn btn-primary btn-xs">Tạo Module</button> -->
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" id="search_account_permission" placeholder="Tìm kiếm" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button> </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Tên Module(*)</th>
                                <th>Mô tả</th>
                               
                            </tr>
                            @foreach($all_account_premission as $key=> $value)
                            <tr>
                                <td style="width:30px;"></td>
                                <td class="project-title">
                                    <p>{{$value->permission}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{$value->description}} </p> 
                                </td>
                                <td class="project-actions">
                                    <button onClick="edit_account_permission({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                                    <!-- <button onClick="delete_account_permission({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button> -->
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
$("#create_account_permission").click( function(){
    
    var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        

        <div class="form-group">
        <label class="col-sm-2 control-label">Tên Module(*)</label>
        <div class="col-sm-10"><input type="text"  id="permission" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>


        <div class="form-group">
        <label class="col-sm-2 control-label">Mô tả</label>
      
        
        <div class="col-sm-10">
            <textarea id="description" class="form-control"  rows="6"></textarea></div>

        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_account_permission()"" type="btn" id="save_news">Thêm Module</button>
        </div>
        </div>
    </div>
    </div> `;
    $('tbody').html(output);       
});
function save_account_permission()
{
    var permission1 = $('#permission').val()
    var description1 = $('#description').val();
    $.ajax({
        type:"GET",
        url:'{{URL::to('/save-account-permission')}}',
        data: {permission: permission1, description: description1 },
        dataType:"json",
        success: function(response)
        {
            console.log(response);
            alert(response['mes']);
        }
    });
}
// function delete_account_permission(id)
// {
//     var r=confirm('Waring! Bạn có muốn xóa không !!');
//     if(r==true)
//     {
//      $.ajax({
//             type:"GET",
//             url:'{{URL::to('/delete-account-permission')}}'+'/'+id,
//             dataType:"json",
//             success: function(response)
//             {
//             var output=`
//                 <tr> 
//                     <th style="width:30px;"></th>
//                     <th>Tên Module(*)</th>
//                     <th>Mô tả</th>
                    
//                 </tr>`;
//                 $('tbody').html('');
//                 response.forEach(function (item) {
//                     console.log(item);
//                 output+=`
//                 <tr>
//                     <td style="width:30px;"></td>
//                     <td class="project-title">
//                         <p>${item.permission}</p>  
//                     </td>
//                     <td class="project-title">
//                         <p> ${item.description} </p> 
//                     </td>

//                     <td class="project-actions">
//                         <button onClick="edit_account_permission(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
//                          <button onClick="delete_account_permission(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
//                     </td>
//                 </tr>`;    
//                 });
//                 $('tbody').html(output);
                
//             }
//         });   
//     }else{
//      alert(r); 
//     }
// }
function edit_account_permission(id)
{
    console.log(id);
    $.ajax({
        type:"GET",
        url:'{{URL::to('/edit-account-permission')}}'+'/'+id,
        dataType:"json",
        success: function(response)
        {
        var output=``;
        $('tbody').html('');  
        output+=`
        <div class="inqbox-content">
        <div  class="form-horizontal">
           
            <div class="form-group">
            <label class="col-sm-2 control-label">Tên module(*):</label>
            <div class="col-sm-10"><label class="col-sm-2 control-label">${response[0].permission}</label></div>
            </div>
            <div class="hr-line-dashed"></div>

        
            <div class="form-group">
            <label class="col-sm-2 control-label">Mô tả(*):</label>
            <div class="col-sm-10">
             <textarea id="description_up" class="form-control"  rows="6">${response[0].description}</textarea></div>
           
            </div>
            <div class="hr-line-dashed"></div>

            
            <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-primary" onClick="update_account_permission(${response[0].id})"" type="btn" id="update_account_customer">cập nhật</button>
            </div>
            </div>
        </div>
        </div> `;
        $('tbody').html(output); 
        }
    });
}
function update_account_permission(id)
{
    console.log(id);
    var permission1 = $('#permission_up').val();
    var description1 = $('#description_up').val();

    $.ajax({
        type:"GET",
        url:'{{URL::to('/update-account-permission')}}'+'/'+id,
        data: {permission: permission1, description :description1 },
        dataType:"json",
        success: function(response)
        {
            alert(response['mes']);
        }
    });
}
$('#search_account_permission').keyup(function(){
    var result = $('#search_account_permission').val();
   // console.log(result);
    $.ajax({
        type:"POST",
        url:'{{URL::to('/search-account-permission')}}',
        data: { result:result},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        success: function(response)
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên Module(*)</th>
                <th>Mô tả</th>
                
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
            output+=`
            <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.permission}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.description} </p> 
                </td>

                <td class="project-actions">
                    <button onClick="edit_account_permission(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                  
                </td>
            </tr>`;    
            });
            $('tbody').html(output);   
        }
    });
});
</script>
@endsection
