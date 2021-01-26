@extends('dashboard')
@section('admin_content') 
   <body>
    <div style="clear: both; height: 63px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="inqbox float-e-margins">
                <div class="inqbox-content">
                    <h2> GÓI KHÁM </h2>
                 
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
                        <button type="btn" onClick="create_service_packet()" class="btn btn-primary btn-xs">Tạo gói khám</button>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" id="search_packet" onkeyup="search_packet()" placeholder="Tìm kiếm" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> <i class="fa fa-search"> </i></button> </span>
                            </div>
                        </div>
                    </div>


                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th>Tên dịch vụ</th>
                                <th>Giá tiền</th>
                                <th style="width:30px;"></th>
                            </tr>
                           
                            
                            @for ($i=0; $i < sizeof($tam) ; $i++)
                            <tr>
                                <td class="project-title">
                                    <p>{{$tam[$i]['name']}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{number_format($tam[$i]['total'])}} VND</p> 
                                </td>

                                <td class="project-actions">
                                   
                                    <button onClick="edit_service_packet({{$tam[$i]['id']}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Xem </button>
                                    <button onClick="delete_service_packet({{$tam[$i]['id']}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
                                </td>

                            </tr>
                            @endfor
                          
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </body>

         <!-- {{--  ////////////////////////danh  sách dịch vụ/////////////////////////  --}} -->

        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Danh sách dịch vụ</h4>
              </div>
              <div class="modal-body">
               <form method="post" id="insert_form">
               <div class="pre-scrollable">
               <div id="list_service_in_packet">    
               
               </div>
                </div>
                
               </form>
              </div>
              <div class="modal-footer"> .  
               
               <button type="button" onClick="update_service_packet_detail()" class="btn btn-default" data-dismiss="modal">Thêm dịch vụ</button>
              </div>
             </div>
            </div>
        </div>
            {{--  ////////////////////////model/////////////////////////  --}}
 
    @endsection
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
function create_service_packet()
{
   var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Tên gói khám</label>
        <div class="col-sm-10"><input type="text"  id="packet_service" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Mô tả</label>
        <div class="col-sm-10">
        <textarea id="packet_content" name="packet_content" rows="6" class="form-control"></textarea></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Thêm dịch vụ</label>
        <div class="col-sm-10"><button type="btn" onClick="list_service()"><img src="{{asset ('backend/icon/add.svg')}}"></button></div>
        </div>

        <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10" >
        <div class="pre-scrollable">
        <div id="show_list"></div>
        
        </div>
        </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_service_packet()"" type="btn" id="save_news"> Lưu gói khám</button>
        </div>
        </div>
    </div>
    </div> `;
    $('tbody').html(output);       
}


function list_service()
{
    //console.log(123);
    $.ajax({
        url: '{{URL::to('/list-service-service')}}',
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output=`<tr> 
                <th>Tên dịch vụ</th>
                <th>Giá tiền</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('#show_list').html('');
            response.forEach(function (item) {
                //console.log(item);
                output+=`
                <tr>
                    <td class="project-title">
                        <p>${item.service}</p>  
                    </td>
                    <td class="project-title">
                        <p> ${formatNumber(item.price)} VND</p> 
                    </td>
                    <td class="project-actions">
                        <input type="checkbox" value="${item.id}">
                    </td>
                </tr>
                 `;
                 
            });
            $('#show_list').append(output); 
        }
    });
}

function save_service_packet()
{
    var arr=[];
   $(':checkbox:checked').each(function(i) {
       arr.push($(this).val());
    });
  // console.log(arr); 
    var packet_service1=$('#packet_service').val();
    var packet_content1=$('#packet_content').val();
    if(packet_service1 =='' || packet_content1 =='')
    {
        alert('Vui lòng điền đủ trường ');
        return ;
    }
    if(arr.length == 0 )
    {
        alert('Vui lòng chọn tối thiếu 1 dịch vụ');
        return ;    
    }
   $.ajax({
        url: '{{URL::to('/save-service-packet')}}',
        type: 'GET',
        data: {arr1: arr, packet_service:packet_service1, packet_content: packet_content1},
        dataType: 'json',
        success: function (response) 
        { 
            if(response['mes']=='Tạo gói khám thành công')
            {
                $('#packet_service').val("");
                $('#packet_content').val("");
                $('input:checkbox').removeAttr('checked');
                alert(response['mes']);

            }else{
                alert(response['mes']);
            }
        }
    });

}
function edit_service_packet(id)
{
    $.ajax({
        url: '{{URL::to('/edit-service-packet')}}'+'/'+id,
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
            <label class="col-sm-2 control-label">Tên gói khám</label>
            <div class="col-sm-10"><input type="text" value="${response[0].packet_service}"  id="packet_service_ud" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
            <label class="col-sm-2 control-label">Mô tả</label>
            <div class="col-sm-10">
            <textarea id="packet_content_ud" name="packet_content_ud" rows="6" class="form-control">${response[0].packet_content}</textarea>
            </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Danh sách </label>
            <div class="col-sm-10"><button class="btn btn-primary fa fa-views" type="btn" onClick="list_service_packet_detail(${response[0].id})" ><i class="fa fa-folder"></i> Xem dịch vụ đã có </button>
            <input type="hidden" id="id_packet" in value="${response[0].id}" > 
            <button onClick="list_service_in_packet(${response[0].id})" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary fa fa-plus"> Thêm dịch vụ </button>
            </div>
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10" >
            <div class="pre-scrollable">
            <div id="show_list_edit"></div>
            </div>
            </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-primary" onClick="update_service_packet(${response[0].id})"" type="btn" id="save_news">Cập nhật gói khám</button>
            </div>
            </div>
        </div>
        </div> 
        `;
        $('tbody').html(output);   
        }
    });   
}
function list_service_in_packet(id) {

    $.ajax({
        url: '{{URL::to('/list-service-in-packet')}}',
        type: 'POST',
        data: {id_packet:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            var output=`
            <tr> 
            <th style="width:55px;"></th>
            <th>Tên dịch vụ</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
            </tr>`;
            $('#list_service_in_packet').html('');
            response.forEach(function (item) {  
          
                output+=`
                <tr>
                <td style="width:55px;"></td>
                    <td class="project-title">
                        <p>${item.service}</p>  
                    </td>
                    <td class="project-title">
                        <p> ${formatNumber(item.price)} VND</p> 
                    </td>
                    <td class="project-actions">
                    <p> <input type="checkbox" value="${item.id}"> </p>
                    </td>
                </tr>
                `;
                
            });
            $('#list_service_in_packet').append(output); 
        }
    });

}
function update_service_packet(id)
{
    var packet_service1=$('#packet_service_ud').val();
    var packet_content1=$('#packet_content_ud').val();
    
    $.ajax({
        url: '{{URL::to('/update-service-packet')}}',
        type: 'POST',
        data: {packet_service:packet_service1, packet_content:packet_content1, id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
             alert(response['mes']);
        }
    });
}
function update_service_packet_detail() {
    var arr=[];
   $(':checkbox:checked').each(function(i) {
       arr.push($(this).val());
    });
    var id = $('#id_packet').val();
   
    $.ajax({
        url: '{{URL::to('/update-service-packet-detail')}}',
        type: 'POST',
        data: {id_packet:id, arr_service:arr},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            alert('Cập nhật gói khám thành công, vui lòng bấm vào danh sách dịch vụ để xem cập nhật mới nhất')
        }
    });
}

/// view edit service packet
function list_service_packet_detail(id)
{

 $.ajax({
    url: '{{URL::to('/list-service-packet-detail')}}',
    type: 'POST',
    data: {id:id},
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: 'json',
    success: function (response) 
    {
     var output=`<tr> 
        <th style="width:30px;"></th>
            <th>Tên dịch vụ</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
        </tr>`;
        $('#show_list_edit').html('');
        response.forEach(function (item) {
        
            output+=`
            <tr>
            <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${formatNumber(item.price)} VND</p> 
                </td>
                <td class="project-actions">
                  <button 
                  onClick="remove_service(${item.id_service_service},${item.id_service_packet})">Xóa</button>
                </td>
            </tr>
             `;
             
        });
        $('#show_list_edit').append(output); 
    }
});


}
function remove_service(id_ser,id_packet)//remove service trong packet
{
    var r =confirm('Bạn có muốn xóa dịch vụ này không ?')
    if(r == true)
    {
    $.ajax({
        url: '{{URL::to('/remove-service-packet-detail')}}',
        type: 'POST',
        data: {id_ser:id_ser,id_packet:id_packet},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
        var output=`<tr> 
            <th>Tên dịch vụ</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
        </tr>`;
        $('#show_list_edit').html('');
        response.forEach(function (item) {
           // console.log(item);
            output+=`
            <tr>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${formatNumber(item.price)} VND</p> 
                </td>
                <td class="project-actions">
                  <button 
                  onClick="remove_service(${item.id_service_service},${item.id_service_packet})">Xóa</button>
                </td>
            </tr>
             `;
             
        });
        $('#show_list_edit').append(output); 
        alert('Xóa dịch vụ khỏi gói khám thành công')
        }
    });
    }else{

    }
}
function delete_service_packet(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
  
    $.ajax({
        url: '{{URL::to('/delete-service-packet')}}',
        type: 'POST',
        data: {id:id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
        var output=`
        <tr> 
            <th>Tên dịch vụ</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
        </tr>`;
        $('tbody').html('');  
        response.forEach(function (item) {
        output+=`
        <tr>
            <td class="project-title">
                <p>${item.name}</p>  
            </td>
            <td class="project-title">
                <p> ${formatNumber(item.total)} VND</p> 
            </td>

            <td class="project-actions">
                
                <button onClick="edit_service_packet(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Xem </button>
                <button onClick="delete_service_packet(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
            </td>

        </tr>`;
        });
         $('tbody').html(output);  
        }
    });
    }else{
        
    }

}
function search_packet()
{
  var keyword1 = $('#search_packet').val();
   // console.log($keyword);
    $.ajax({
        url: '{{URL::to('/search-packet')}}',
        type: 'POST',
        data: {keyword:keyword1},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
          
            var output=`
        <tr> 
            <th>Tên dịch vụ</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
        </tr>`;
        $('tbody').html('');  
        response.forEach(function (item) {
        output+=`
        <tr>
            <td class="project-title">
                <p>${item.name}</p>  
            </td>
            <td class="project-title">
                <p> ${formatNumber(item.total)} VND</p> 
            </td>

            <td class="project-actions">
        
                <button onClick="edit_service_packet(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Xem </button>
                <button onClick="delete_service_packet(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Xóa </button>
            </td>

        </tr>`;
        });
         $('tbody').html(output);  
        }
    });

}

</script>
