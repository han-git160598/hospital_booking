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
                        <button type="btn" onClick="create_service_packet()" class="btn btn-primary btn-xs">Tạo gói khám</button>
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
                                <th>Tên dịch vụ</th>
                                <th>Giá tiền</th>
                                <th style="width:30px;"></th>
                            </tr>
                            @foreach($all_service_packet as $key=> $value)
                    
                            @for ($i=0; $i < sizeof($tam) ; $i++)
                            <tr>
                                <td class="project-title">
                                    <p>{{$tam[$i]['name']}}</p>  
                                </td>
                                <td class="project-title">
                                    <p> {{number_format($tam[$i]['total'])}} VND</p> 
                                </td>

                                <td class="project-actions">
                                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                    <button onClick="edit_service({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </button>
                                    <button onClick="delete_service({{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-remove"></i> Delete </button>
                                </td>
                            </tr>
                            @endfor
                            
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
function create_service_packet()
{
   var output=``;
    $('tbody').html('');  
    output+=`
    <div class="inqbox-content">
    <div  class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Tên gói khám</label>
        <div class="col-sm-10"><input type="text"  id="title_news" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Mô tả</label>
        <div class="col-sm-10"><input type="text"  id="content_news" class="form-control"></div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Thêm dịch vụ</label>
        <div class="col-sm-10"><button type="btn" onClick="list_service()"></a><img src="{{asset ('backend/icon/add.svg')}}"></button></div>
        </div>

        <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10" >
        <tr><td id="show_list"></td> <td id="select_list"></td></tr>
        </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2">
            <button class="btn btn-primary" onClick="save_news()"" type="btn" id="save_news">Lưu gói kham</button>
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
            $('show_list').html('');
            response.forEach(function (item) {
                //console.log(item);
                output+=`
                <tr>
                    <td class="project-title">
                        <p>${item.service}</p>  
                    </td>
                    <td class="project-title">
                        <p> ${item.price}</p> 
                    </td>
                    <td class="project-actions">
                        <input type="checkbox" value="${item.id}">
                    </td>
                  
                    </td>
                </tr>
                 `;
            });
            $('#show_list').append(output); 
        }
    });
}

function save_news()
{
    var arr=[];
   $(':checkbox:checked').each(function(i) {
       arr.push($(this.value));
    });
}


</script>
