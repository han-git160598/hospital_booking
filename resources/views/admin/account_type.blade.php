@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 20px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> LOẠI TÀI KHOẢN </h2>
                    
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox">
                <div class="inqbox-title">
                    <h5><a class="btn btn-sm btn-primary" href="{{URL::to('/all-account-type')}}"> Danh sách </a> </h5>
                    <div class="inqbox-tools">
                        <button id="create_account_type" class="btn btn-primary btn-xs">Tạo loại account</button>
                    </div>
                </div>
                <div class="inqbox-content">
                        <div class="row m-b-sm m-t-sm">
                            
                            <!-- <div class="col-md-11">
                                <div class="input-group"><input type="text" placeholder="Tìm kiếm" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button> </span>
                                </div>
                            </div> -->
                        </div>
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Tên bài viêt</th>
                                <th>Nội dung</th>
                                <th></th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($all_account_type as $key=> $value)
                            <tr>
                                <td  style="width:30px;"</td>
                                <td class="project-title">
                                    <p>{{$value->type_account}}<p>
                                </td>
                                <td class="project-title">
                                    <p>{{$value->description}}<p>
                                </td>

                                <td class="project-actions">
                                    <button onClick="edit_account_type({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                                    <button onClick="delete_account_type({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
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
$("#create_account_type").click( function(){
    
    var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Chức vụ (*)</label>
        <div class="col-sm-10"><input type="text"  id="type_account" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>
        
        <div class="form-group">
        <label class="col-sm-2 control-label">Mô tả (*)</label>
        <div class="col-sm-10">
        <div id="ckeditor-inline2" contenteditable="true">
        <textarea id="wmd-input" name="post-text" class="wmd-input s-input bar0 js-post-body-field processed" data-post-type-id="2" cols="90" rows="10" tabindex="101" data-min-length=""></textarea>
        </div></div></div>
        <div class="hr-line-dashed"></div>  

        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_account_type()"" type="btn" id="save_account_type">Thêm</button>
        </div>
        </div>
    </div>
    </div> `;
    $('tbody').html(output);       
});
function save_account_type()
{
    var type_account1 = $('#type_account').val();
    var description1 = $('#wmd-input').val();
   // console.log(description1);
    $.ajax({
        url: '{{URL::to('/save-account-type')}}',
        type: 'GET',
        data: {type_account: type_account1, description: description1 },
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);
        }
    }); 
}
function delete_account_type(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không ?');
    if(r==true)
    {
    $.ajax({
        url: '{{URL::to('/delete-account-type')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            console.log(response);
            if(response['mes']=='sucsses')
            {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên bài viêt</th>
                <th>Nội dung</th>
                <th></th>
                <th style="width:30px;"></th>
            </tr>`;
            response['data'].forEach(function (item) {
            output+=`
            <tr>
                <td  style="width:30px;"</td>
                <td class="project-title">
                    <p>${item.type_account}<p>
                </td>
                <td class="project-title">
                    <p>${item.description}<p>
                </td>

                <td class="project-actions">
                    <button onClick="edit_account_type(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    <button onClick="delete_account_type(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
            </tr>`;       
            });
            $('tbody').html(output);  
            alert('Xóa chức vụ thành công');
            }else{
                alert(response['mes']);
            }
        }
    }); 
    }else{
        
    }
}
function edit_account_type(id)
{
     $.ajax({
        url: '{{URL::to('/edit-account-type')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
        var output=``;
        $('tbody').html('');  
        output+=`
        <div class="inqbox-content">
        <div  class="form-horizontal">
            <div class="form-group">
            <label class="col-sm-2 control-label"> Chức vụ (*)</label>
            <div class="col-sm-10"><input type="text" value="${response[0].type_account}" id="type_account_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Mô tả (*)</label>
            <div class="col-sm-10">
            <div id="ckeditor-inline2" contenteditable="true">
            <textarea id="wmd-input_ud" name="post-text" class="wmd-input s-input bar0 js-post-body-field processed" data-post-type-id="2" cols="90" rows="10" tabindex="101" data-min-length="">${response[0].description}</textarea>
            </div></div></div>
            <div class="hr-line-dashed"></div>  

            <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-primary" onClick="update_account_type(${response[0].id})"" type="btn" id="save_account_type">Cập nhật</button>
            </div>
            </div>
        </div>
        </div> `;
        $('tbody').html(output);  
        }
      }); 
}
function update_account_type(id)
{
    console.log(id);
    var type_account1 = $('#type_account_ud').val();
    var description1 = $('#wmd-input_ud').val();
    console.log(description1);console.log(type_account1);
    $.ajax({
        url: '{{URL::to('/update-account-type')}}'+'/'+id,
        type: 'GET',
        data: {type_account: type_account1, description: description1 },
        dataType: 'json',
        success: function (response) 
        {
            //console.log(response);
            alert(response['mes']);
        }
    }); 
}
</script>
@endsection
