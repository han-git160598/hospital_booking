@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> BÀI VIẾT </h2>
                   
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
                         <button type="button" name="x" id="x" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Thêm bài viết</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" id="search_news" placeholder="Tìm kiếm" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> </button> </span>
                            </div>
                        </div>
                    </div>
            
                      {{--  model thêm  --}}
    <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Thêm sản phẩm</h4>
              </div>
              <div class="modal-body">

            <form id="insert_news_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>Tên bài viết (<font style="color: red">*</font>)</label>
            <input type="text" name="name_news" id="name_news" class="form-control" />
            <br/>
             <label>Nội dung bài viết (<font style="color: red">*</font>)</label>
             <textarea name="content_news" rows="8" id="content_news" class="form-control"></textarea>
          
            <br/>
            <label><label>Hình ảnh </label>
                <input type="file" id="img_news"  name="img_news" class="form-control" multiple="multiple"  placeholder="Hình ảnh">
                </label>
            <br/>
                <span id="upload_ed_image"></span>
            <br/>
            <br/>
            <input type="submit" name="insert" id="insert_category" value="Thêm" class="btn btn-success" />
           </form>
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
             </div>
            </div>
           </div>
            {{--  update    --}}
             <div id="update_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Thêm sản phẩm</h4>
              </div>
              <div class="modal-body">

            <form id="update_news_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>Tên bài viết (<font style="color: red">*</font>)</label>
            <input type="text" name="name_news_ud" id="name_news" class="form-control" />
            <br/>
             <label>Nội dung bài viết (<font style="color: red">*</font>)</label>
             <textarea name="content_news_ud" rows="8" id="content_news" class="form-control"></textarea>
           <div id="id_news"> </div>
            <br/>
            <label><label>Hình ảnh (<font style="color: red">*</font>)</label>
                <input type="file" id="img_news"  name="img_news_ud" class="form-control" multiple="multiple"  placeholder="Hình ảnh">
                </label>
            <br/>
                <span id="upload_ed_image"></span>
            <br/>
            <br/>
            <input type="submit" name="update" id="insert_category" value="Thêm" class="btn btn-success" />
           </form>
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
             </div>
            </div>
           </div>
  
                    {{--  --------  --}}
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Tên bài viêt</th>
                                <th>Nội dung</th>
                                <th>Hình ảnh</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($all_news as $key=> $value)
                            <tr id="{{$value->id}}">
                            @if($value->home_action == 'Y')
                                <td class="project-status">
                                    <button class="label label-primary" onClick="disable_news({{$value->id}})" >Disable</button>
                                </td>
                            @else
                                <td class="project-status">
                                    <button class="label label-primary" onClick="enable_news({{$value->id}})" >Enable</button>
                                </td>
                            @endif
                                <td class="project-title">
                                    <p>{{substr($value->title, 0, 200)}} <p>
                                </td>
                                <td class="project-title">
                                    <p>{{substr($value->content, 0, 200)}} <p>
                                </td>
                                <td >
                                <img alt="Image" height="100" width="100" src="{{$value->image_upload}}">
                                </td>
                                <td class="project-actions">
                                    <button onClick="edit_news({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                                      {{--  <button type="button" name="x" id="x" data-toggle="modal" data-target="#update_data_Modal"><i class="fa fa-pencil"></i> Sửa </button>  --}}
                                </td>
                                <td class="project-actions">
                                    <button onClick="delete_news({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
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
$( document ).ready(function() {
    $('#insert_news_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{URL::to('/save-news')}}',
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                 alert(response['mes']);
                 console.log(response['data']);
            if(response['data'] != 'faild')
            {
                 var output=`
                <tr> 
                    <th style="width:30px;"></th>
                    <th>Tên bài viêt</th>
                    <th>Nội dung</th>
                    <th>Hình ảnh</th>
                    <th style="width:30px;"></th>
                </tr>`;
                $('tbody').html('');
                response['data'].forEach(function (item) {
                  //  console.log(item);
                output+=`
                <tr>`;
                if(item.home_action == 'Y')
                output+=` 
                    <td class="project-status">
                        <button class="label label-primary" onClick="disable_news(${item.id})" >Disable</button>
                    </td>`;
                else
                output+=`  
                    <td class="project-status">
                        <button class="label label-primary" onClick="enable_news(${item.id}))" >Enable</button>
                    </td>`;  
                output+=`
                    <td class="project-title">
                        <p>${item.title.substr(0, 200)}<p>
                    </td>
                    <td class="project-title">
                        <p>${item.content.substr(0, 200)}<p>

                    </td>
                    <td >
                        <img alt="" height="150" width="150" src="${item.image_upload}">
                    </td>
                    <td class="project-actions">
                        <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                        <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                    </td>
                </tr>`;    
                
                });
            }
            $('tbody').html(output);   
            }
        })
    });

    $('#update_news_form').on('submit', function(event) {
       event.preventDefault();
         $.ajax({
           url: '{{URL::to('/update-news')}}',
             method: "POST",
             data: new FormData(this),
             dataType: 'JSON',
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             contentType: false,
             cache: false,
             processData: false,
             success: function(data) 
             {
                 console.log(data);
                 var output=``;
             
                  if(data['data'][0].home_action == 'Y')
                output+=`
                    <td class="project-status">
                        <button class="label label-primary" onClick="disable_news(${data['data'][0].id})" > Disable</button>
                    </td>`;
                else
                 output+=`
                    <td class="project-status">
                        <button class="label label-primary" onClick="enable_news(${data['data'][0].id})"> Enable</button>
                    </td>`;
                output+=`
                    <td class="project-title">
                        <p>${data['data'][0].title.substr(0, 200)} <p>
                    </td>
                    <td class="project-title">
                        <p>${data['data'][0].content.substr(0, 200)} <p>
                    </td>
                    <td >
                    <img alt="Image" height="100" width="100" src="${data['data'][0].image_upload}">
                    </td>
                    <td class="project-actions">
                        <button onClick="edit_news(${data['data'][0].id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                        
                    </td>
                    <td class="project-actions">
                        <button onClick="delete_news(${data['data'][0].id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                    </td>`;
                   $('#'+data['data'][0].id).html(output);   
             }
         });
    });
});
function edit_news(id)
{
    console.log(id);
$.ajax({
        url: '{{URL::to('/edit-news')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {   
            console.log(response);
           
        var output=`
            <label>Tên bài viết (<font style="color: red">*</font>)</label>
            <input type="text" name="name_news_ud" value="${response[0].title}"  id="name_news" class="form-control" />
            <br/>
             <label>Nội dung bài viết (<font style="color: red">*</font>)</label>
             <textarea name="content_news_ud" rows="8" id="content_news" class="form-control">${response[0].content}</textarea>
            <input type="text" name="id_news" value="${response[0].id}" class="form-control" />
            <br/>
            <label><label>Hình ảnh (<font style="color: red">*</font>)</label>
            <input type="file" id="img_news" value="${response[0].image_upload}" accept="image/png, image/jpeg" name="img_news_ud" class="form-control" multiple="multiple"  placeholder="Hình ảnh">
            <img src="${response[0].image_upload}" height="150" width="200" >
            </label>
            <br/>
                <span id="upload_ed_image"></span>
            <br/>
            <br/>
            <input type="submit" name="update" id="insert_category" value="Cập nhật" class="btn btn-success" />
           `;
         $('#update_news_form').html(output); 


        }
    });
    $('#update_data_Modal').modal('show');
}

 
function delete_news(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
    $.ajax({
        url: '{{URL::to('/delete-news')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên bài viêt</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>`;
            if(item.home_action == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_news(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_news(${item.id}))" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.title.substr(0, 200)}<p>
                </td>
                <td class="project-title">
                    <p>${item.content.substr(0, 200)}<p>

                </td>
                <td >
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);   
        }
    }); 
    }else{
        
    }
}



function disable_news(id)
{
    $.ajax({
        url: '{{URL::to('/disable-news')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên bài viêt</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
            </tr>`;
            response.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>`;
            if(item.home_action == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_news(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_news(${item.id})" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.title.substr(0, 200)}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.content.substr(0, 200)} VND</p> 
                </td>
                <td >
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });   
}
function enable_news(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/enable-news')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên bài viêt</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
            </tr>`;
            response.forEach(function (item) {
                console.log(item);
            output+=`
            <tr>`;
            if(item.home_action == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_news(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_news(${item.id})" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.title.substr(0, 200)}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.content.substr(0, 200)} VND</p> 
                </td>
                <td >
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });       
}
$('#search_news').keyup(function(){
    var result= $('#search_news').val();
    $.ajax({
        type:"POST",
        url:'{{URL::to('/search-news')}}',
        data: { result:result},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        success: function(response)
        {
         var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên bài viêt</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
               
            output+=`
            <tr>`;
            if(item.home_action == 'Y')
            output+=` 
                <td class="project-status">
                     <button class="label label-primary" onClick="disable_news(${item.id})" >Disable</button>
                </td>`;
            else
            output+=`  
                <td class="project-status">
                     <button class="label label-primary" onClick="enable_news(${item.id}))" >Enable</button>
                </td>`;  
            output+=`
                <td class="project-title">
                    <p>${item.title.substr(0, 200)}<p>
                </td>
                <td class="project-title">
                    <p>${item.content.substr(0, 200)}<p>

                </td>
                <td >
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);     
        }
    });
});
</script>
@endsection
