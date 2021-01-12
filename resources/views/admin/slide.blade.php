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
                          <button type="button" name="x" id="x" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Thêm Slide</button>
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
                    {{--  model thêm  --}}
    <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Thêm Slide</h4>
              </div>
              <div class="modal-body">  

            <form id="insert_category_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>Số thứ tự (<font style="color: red">*</font>)</label>
            <input type="text" name="stt_slide" id="stt_slide" class="form-control" />
            <br/>
            <label><label>Hình ảnh (<font style="color: red">*</font>)</label>
                <input type="file" id="img_slide"  name="img_slide" class="form-control" multiple="multiple"  placeholder="Hình ảnh">
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
             {{--  model Sửa  --}}
        <div id="update_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Sửa slide</h4>
              </div>
              <div class="modal-body">

            <form id="update_category_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>Số thứ tự (<font style="color: red">*</font>)</label>
            <input type="text" name="stt_slide_ud" id="stt_slide" class="form-control" />
         
            <br/>
            <label><label> Hình ảnh (<font style="color: red">*</font>)</label>
                <input type="file" id="img_slide"  name="img_slide_ud" class="form-control" multiple="multiple"  placeholder="Hình ảnh">
                </label>
            <br/>
                <span id="upload_ed_image"></span>
            <br/>
          <div id="id_slide">
          
          </div>
            <br/>
            <input type="submit" name="update" id="insert_category" value="Cập nhật" class="btn btn-success" />
           </form>
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
             </div>
            </div>
           </div>
            {{-- ------------------------------------------------------}}
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th style="width:30px;"></th>
                                <th>Số thứ tự</th>
                                <th>Hình ảnh</th>
                                <th style="width:30px;"></th>
                                <th style="width:30px;"></th>
                               
                            </tr>
                            @foreach($all_slide as $key=> $value)
                            <tr>
                                <td style="width:30px;"></td>
                                <td style="width:30px;"></td>
                                <td class="project-title">
                                    <p>{{$value->order_slide}}<p>
                                </td>
                                <td class="project-title">
                                <img src="{{$value->image_upload}}" height="150" width="150" alt="Image">
                                </td>
                                <td class="project-actions">
                                    <button onClick="edit_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                                    <!-- <button type="button" name="x" id="{{$value->id}}" data-toggle="modal" data-target="#update_data_Modal" class="btn btn-white btn-sm" ><i class="fa fa-remove"></i> Sửa Slide</button> -->
                                </td>                               
                                <td class="project-actions">       
                                    <button onClick="delete_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
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
    $('#insert_category_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{URL::to('/save-slide')}}',
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON', 
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                alert(data['mes']);
            if(data['data'] == 'faild')
            {

            }else{    
                var output=`
                <tr> 
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                    <th>Số thứ tựt</th>
                    <th>Hình ảnh</th>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"></th>
                </tr>`;
                $('tbody').html('');
                data['data'].forEach(function (item) {
                output+=`
                <tr> <th style="width:30px;"></th>
                    <td  style="width:30px;"></td>
                    <td class="project-title">
                        <p>${item.order_slide}<p>
                    </td>
                    <td >
                    <img src="${item.image_upload}" height="150" width="150" alt="Image">
                    </td>
                    <td class="project-actions">
                    <button onClick="edit_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                </td>
                    <td class="project-actions">
                        <button onClick="delete_slide(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                    </td>
                    
                </tr>`;    
                });
                $('tbody').append(output);
                } 
            }
        })
    });

    
   
});
function edit_slide(id)
{
    console.log(id);
$.ajax({
        url: '{{URL::to('/edit-slide')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {   
            var output=`
            <input type="text" name="id_slide" value="${id}" class="form-control" /> `;
           $('#id_slide').html(output); 
        }
    });
$('#update_data_Modal').modal('show');

}  
$('#update_category_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{URL::to('/update-slide')}}',
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) 
            {
            // console.log(data);
                    alert(data['mes']);
                if(data['data'] == 'faild')
                {

                }else{
                    var output=`
                    <tr> 
                        <th style="width:30px;"></th>
                        <th style="width:30px;"></th>
                        <th>Số thứ tựt</th>
                        <th>Hình ảnh</th>
                        <th style="width:30px;"></th>
                        <th style="width:30px;"></th>
                    </tr>`;
                    $('tbody').html('');
                    data['data'].forEach(function (item) {
                    
                output+=`
                <tr> <th style="width:30px;"></th>
                    <td  style="width:30px;"></td>
                    <td class="project-title">
                        <p>${item.order_slide}<p>
                    </td>
                    <td >
                    <img src="${item.image_upload}" height="150" width="150" alt="Image">
                    </td>
                        <td class="project-actions">
                        <button onClick="edit_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
                    </td>
                    <td class="project-actions">
                        <button onClick="delete_slide(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                    </td>
                    
                </tr>`;    
                });
                $('tbody').html(output);
                location.reload();
                }
            }
           
        });

    });

function delete_slide(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
    $.ajax({
        url: '{{URL::to('/delete-slide')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th style="width:30px;"></th>
                <th>Số thứ tựt</th>
                <th>Hình ảnh</th>
                <th style="width:30px;"></th>
                 <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
               
            output+=`
            <tr> <th style="width:30px;"></th>
                <td  style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.order_slide}<p>
                </td>
                <td >
                <img src="${item.image_upload}" height="150" width="150" alt="Image">
                </td>
                 <td class="project-actions">
                 <button onClick="edit_slide({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Sửa </button>
               </td>
                <td class="project-actions">
                    <button onClick="delete_slide(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                </td>
                
                
                
            </tr>`;    
            });
            $('tbody').html(output);   
        }
    }); 
    }else{
        
    }
}

// {{--  function edit_slide(id)
// {
//     console.log(id);
//     $.ajax({
//         url: '{{URL::to('/edit-slide')}}'+'/'+id,
//         type: 'GET',
//         dataType: 'json',
//         success: function (response) 
//         {
//         var output=``;
//         $('tbody').html('');  
//         output+=`
//         <div class="inqbox-content">
//         <div  class="form-horizontal">
//             <div class="form-group">
//             <label class="col-sm-2 control-label">Số thứ tự</label>
//             <div class="col-sm-10"><input type="text" value="${response[0].order_slide}"  id="order_slide_ud" class="form-control"></div>
//             </div>
//             <div class="hr-line-dashed"></div>
            
//             <div class="form-group">
//             <label class="col-sm-2 control-label">Hình ảnh</label>
//             <div class="col-sm-10"><input type="file" id="image_upload_slide_ud"></div>
//             </div>
//             <div class="hr-line-dashed"></div>  
//             <div class="form-group">
//             <div class="col-sm-6 col-sm-offset-2">
//                 <button class="btn btn-primary" onClick="update_Slide(${response[0].id})"" type="btn" id="update_Slide">Cập nh</button>
//             </div>
//             </div>
//         </div>
//         </div> `;
//         $('tbody').html(output);     
//         }
//     });
// }  --}}

// function update_Slide(id)
// {
//     var order_slide1 = $('#order_slide_ud').val();
//     var image_upload_slide1 = $('#image_upload_slide_ud').val();
//    console.log(image_upload_slide1);
//     $.ajax({
//         url: '{{URL::to('/update-slide')}}'+'/'+id,
//         type: 'GET',
//         data: {order_slide: order_slide1, image_upload_slide: image_upload_slide1 },
//         dataType: 'json',
//         success: function (response) 
//         {
//             alert(response['mes']);    
//         }
//     });
// }
</script>
@endsection
