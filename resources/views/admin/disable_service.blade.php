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
                        <a href="{{URL::to('/add-service-service')}}" class="btn btn-primary btn-xs">Tạo sản phẩm</a>
                    </div>
                </div>
                <div class="inqbox-content">
                    <div class="row m-b-sm m-t-sm">
                      
                        <div class="col-md-11">
                            <div class="input-group"><input id="search_service_disable" onkeyup="search_service_disable()" type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span>
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
                            @foreach($disable_service as $key=> $value)
                            <tr>
                                <td class="project-title">
                                    <p>{{$value->service}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{number_format($value->price)}} VND</p> 
                                </td>
                                <td class="project-actions">
                                    <button onClick="enable_service({{$value->id}})" class="btn btn-primary btn-sm">Phục hồi </button>
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
function enable_service(id)
{
    console.log(id);
    $.ajax({
        url: '{{URL::to('/enable-service-service')}}'+'/'+id,
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
                    <button onClick="enable_service(${item.id})" class="btn btn-primary btn-sm">Phục hồi </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output);        
        }
    });
}
function search_service_disable()
{
    var search_service1 = $('#search_service_disable').val();
    $.ajax({
    url: '{{URL::to('/search-service-disable')}}',
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
                    <button onClick="enable_service(${item.id})" class="btn btn-primary btn-sm">Phục hồi </button>
                </td>
            </tr>`;    
            });
            $('tbody').html(output); 
    }
    });
}

</script>