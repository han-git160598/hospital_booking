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
                    <h5></h5>
                    <div class="inqbox-tools">
                        <a href="{{URL::to('/add-service-service')}}" class="btn btn-primary btn-xs">Tạo sản phẩm</a>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" onkeyup="search_service()" id="search_service" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" id="btnn"  class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="project-list">
                        <table class="table table-hover">
                            <tbody>      
                            <tr> 
                                <th style="width:30px;"></th>
                                <th>Tên dịch vụ</th>
                                <th>Giá tiền</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($allservice_service as $key=> $value)
                            <tr>
                                <td style="width:30px;"></td>
                                <td class="project-title">
                                    <p>{{$value->service}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{number_format($value->price)}} VND</p> 
                                </td>

                                <td class="project-actions">
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                    <button onClick="edit_service({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                                    <button onClick="delete_service({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
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
    @endsection

<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
function delete_service(id)
{
    var r=confirm('Waring! Bạn có muốn xóa không !!');
    if(r==true)
    {
    console.log(id)
    $.ajax({
        url: '{{URL::to('/delete-service-service')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
        if (response['mes'])
        {
            alert(response['mes']);
        }else{
         var output=`
             <tr> 
                <th>Tên dịch vụ</th>
                <th>Giá tiền</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                console.log(item.service);
            output+=`
            <tr>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.price} VND</p> 
                </td>
                <td class="project-title">
                    <p> ${item.status_service} VND</p> 
                </td>
                <td class="project-actions">
                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                    <button onClick="edit_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output); 
        }   
        }
    });
    }else{
        
    }
}
function edit_service(id)
{
    console.log(id)
     $.ajax({
        url: '{{URL::to('/edit-service-service')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
            var output='';
            $('tbody').html('');
            response.forEach(function (item) {
                output+=`
                 <div class="inqbox-content">
                <div  class="form-horizontal">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Tên dịch vụ</label>
                        <div class="col-sm-10"><input type="text" value="${item.service}"  id="service" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Giá</label>
                        <div class="col-sm-10"> <input type="number" value="${item.price}" id="price" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Nội dung</label>
                        <input type="text" hidden id="id_disable" value="${item.id}">
                        <div class="col-sm-10"><input type="text" value="${item.content}" id="content" class="form-control"></div>
                     </div>
                     <div class="hr-line-dashed"></div>  
                     <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                           <a href="{{URL::to('all-service-service')}}" class="btn btn-white" type="btn">Quay lại danh sách</a>
                           <button class="btn btn-primary" onClick="update_service(${item.id})" type="btn" value="${item.id}" id="update_service">Cập nhật</button>
                            <button onClick="disable_service(${item.id})" class="btn btn-primary" >Vô hiệu hóa</button>
                        </div>
                     </div>
                  </div>
               </div> `;
            });
            $('tbody').html(output); 
        }
     });
   
}
function update_service(id)
{
    var service1=$('#service').val();
    var content1=$('#content').val();
    var price1=$('#price').val();
    console.log(service1);
    console.log(content1);
    console.log(price1);
    $.ajax({
        url: '{{URL::to('/update-service-service')}}'+'/'+id,
        type: 'GET',
        data: {service: service1, content: content1, price: price1 },
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
                console.log(item.service);
            output+=`
            <tr>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.price} VND</p> 
                </td>
                <td class="project-title">
                    <p> ${item.status_service} VND</p> 
                </td>
                <td class="project-actions">
                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                    <button onClick="edit_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);
        }
    });  
}
function disable_service(id)
{
    $.ajax({
        url: '{{URL::to('/disable-service-service')}}'+'/'+id,
        type: 'GET',
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
                console.log(item.service);
            output+=`
            <tr>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p> ${item.price} VND</p> 
                </td>
                <td class="project-title">
                    <p> ${item.status_service} VND</p> 
                </td>
                <td class="project-actions">
                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                    <button onClick="edit_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);        
        }
    });
}
function search_service()
{
    var search_service1 = $('#search_service').val();
    $.ajax({
    url: '{{URL::to('/search-service-service')}}',
    type: 'POST',
    data: {service:search_service1},
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: 'json',
    success: function (response) 
    { 
        //console.log(response);
         var output=`
            <tr> 
                <th style="width:30px;"></th>
                <th>Tên dịch vụ</th>
                <th>Giá tiền</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('tbody').html('');
            response.forEach(function (item) {
                //console.log(item);
            output+=`
           <tr>
                <td style="width:30px;"></td>
                <td class="project-title">
                    <p>${item.service}</p>  
                </td>
                <td class="project-title">
                    <p>${item.price} VND</p> 
                </td>

                <td class="project-actions">
                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                    <button onClick="edit_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                    <button onClick="delete_service(${item.id})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output); 
    }
    });
}

</script>