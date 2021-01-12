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
                         <button type="button" name="x" id="x" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Thêm bài viết</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" id="search_news" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </div>
                    </div>
                    {{--  Model Thêm  --}}
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
             <textarea name="content_news" id="content_news" class="form-control"></textarea>
          
            <br/>
            <label><label>Hình ảnh (<font style="color: red">*</font>)</label>
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
            {{--    --}}
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
                            <tr>
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
                                    <p>{{substr($value->title, 0,  50)}}...<p>
                                </td>
                                <td class="project-title">
                                    <p>{{substr($value->content, 0,  100)}}...<p>

                                </td>
                                <td class="project-people">
                                <img alt="" height="150" width="150" src="{{$value->image_upload}}">
                                </td>
                                <td class="project-actions">
                                    <button onClick="edit_news({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                                    <button onClick="delete_news({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
            success: function(data) {
                 alert(response['mes']);
            }
        })
    });

    
});


function save_news()
{
    var title1 = $('#title_news').val();
    var content1 = $('#content_news').val();
    var image_upload_news1 = $('#image_upload_news').val();
    console.log(title1);
    console.log(content1);
    console.log(image_upload_news1);
    $.ajax({
        url: '{{URL::to('/save-news')}}',
        type: 'GET',
        data: {title: title1, content: content1, image_upload: image_upload_news1 },
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);
        }
    }); 
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
                    <p>${item.title}<p>
                </td>
                <td class="project-title">
                    <p>${item.content}<p>

                </td>
                <td class="project-people">
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);   
        }
    }); 
    }else{
        
    }
}
function edit_news(id)
{
     $.ajax({
        url: '{{URL::to('/edit-news')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=``;
            $('tbody').html('');  
            response.forEach(function (item) {
            output+=`
            <div class="inqbox-content">
            <div  class="form-horizontal">
                <div class="form-group">
                <label class="col-sm-2 control-label">Tên bài viêt</label>
                <div class="col-sm-10"><input type="text" value="${item.title}"  id="title_news" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <label class="col-sm-2 control-label">Nội dung</label>
                <div class="col-sm-10"><input type="text" value="${item.content}"  id="content_news" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <label class="col-sm-2 control-label">Hình ảnh</label>
                <div class="col-sm-10"><input type="file"  id="image_upload_news"></div>
                </div>
                <div class="hr-line-dashed"></div>  
                <div class="form-group">
                <div class="col-sm-6 col-sm-offset-2">
                    <button class="btn btn-primary" onClick="update_news(${item.id})"" type="btn" id="save_news">Cập nhật</button>
                </div>
                </div>
            </div>
            </div> `;
            $('tbody').html(output);  
            });
        }
     });
}
function update_news(id)
{
    var title1 = $('#title_news').val();
    var content1 = $('#content_news').val();
    var image_upload_news1 = $('#image_upload_news').val();
    console.log(id);
    console.log(content1);
    console.log(image_upload_news1);
    $.ajax({
        url: '{{URL::to('/update-news')}}'+'/'+id,
        type: 'GET',
        data: {title: title1, content: content1, image_upload: image_upload_news1 },
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);
        }
    }); 

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
                    <p>${item.title}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.content} VND</p> 
                </td>
                <td class="project-people">
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
                    <p>${item.title}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.content} VND</p> 
                </td>
                <td class="project-people">
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
                    <p>${item.title}<p>
                </td>
                <td class="project-title">
                    <p>${item.content}<p>

                </td>
                <td class="project-people">
                     <img alt="" height="150" width="150" src="${item.image_upload}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_news(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);     
        }
    });
});
</script>
@endsection
