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
                        <button id="create_slide" class="btn btn-primary btn-xs">Thêm Slide</button>
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
                                <th>Số thứ tự</th>
                                <th>Hình ảnh</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($all_slide as $key=> $value)
                            <tr>
                                <td style="width:30px;"></td>
                                <td class="project-title">
                                    <p>{{$value->order_slide}}<p>
                                </td>
                                 <td class="project-people">
                                <img   src="{{$value->image_upload}}">
                                </td>
                                <td class="project-actions">
                                    <button onClick="edit_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                                    <button onClick="delete_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
$("#create_slide").click( function(){
    
    var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Số thứ tự</label>
        <div class="col-sm-10"><input type="text"  id="order_slide" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>
        
        <div class="form-group">
        <label class="col-sm-2 control-label">Hình ảnh</label>
        <div class="col-sm-10"><input type="file" name="image_upload_slide" multiple="multiple" id="image_upload_slide"></div>
        </div>
        <div class="hr-line-dashed"></div>  
        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_Slide()"" type="btn" id="save_Slide">Thêm</button>
        </div>
        </div>
    </div>
    </div> `;
    $('tbody').html(output);       
});
function save_Slide()
{
    var order_slide1 = $('#order_slide').val();
   //var image_upload_slide1 = $('#image_upload_slide').val();
    //console.log(image_upload_slide1);
  // var image_upload_slide1 = $('#image_upload_slide').prop('files');
   var image_upload_slide1 = $('#image_upload_slide')[0].files[0];
    console.log(image_upload_slide1.name);
    $.ajax({
        url: '{{URL::to('/save-slide')}}',
       type: 'GET',
       data: {order_slide: order_slide1, image_upload_slide: image_upload_slide1 },
       dataType: 'json',
       success: function (response) 
       {
          alert(response['mes']);
       }
    }); 
}
function delete_slide(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/delete-slide')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Số thứ tựt</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
               
            output+=`
            <tr>
                <td  style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.order_slide}<p>
                </td>
                <td class="project-people">
                    <img alt="" height="100" width="100" src="{{ asset('backend/img/demo.PNG')}}">
                </td>
                <td class="project-actions">
                    <button onClick="edit_slide(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_slide(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);   
        }
    }); 
}
function edit_slide(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/edit-slide')}}'+'/'+id,
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
            <label class="col-sm-2 control-label">Số thứ tự</label>
            <div class="col-sm-10"><input type="text" value="${response[0].order_slide}"  id="order_slide_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Hình ảnh</label>
            <div class="col-sm-10"><input type="file" id="image_upload_slide_ud"></div>
            </div>
            <div class="hr-line-dashed"></div>  
            <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-primary" onClick="update_Slide(${response[0].id})"" type="btn" id="update_Slide">Cập nh</button>
            </div>
            </div>
        </div>
        </div> `;
        $('tbody').html(output);     
        }
    });
}
function update_Slide(id)
{
    var order_slide1 = $('#order_slide_ud').val();
    var image_upload_slide1 = $('#image_upload_slide_ud').val();
   
    $.ajax({
        url: '{{URL::to('/update-slide')}}'+'/'+id,
        type: 'GET',
        data: {order_slide: order_slide1, image_upload_slide: image_upload_slide1 },
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);    
        }
    });
}
</script>
@endsection
