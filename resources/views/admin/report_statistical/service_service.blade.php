@extends('dashboard')
@section('admin_content') 
      <div style="clear: both; height: 61px;"></div>
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <div class="inqbox float-e-margins">
                     <div class="inqbox-content">
                        <h2><strong>Báo cáo thông kê dịch vụ </strong></h2>
                        <button type="button" onClick="list_service()" data-toggle="modal" data-target="#list_service_modal" class="btn btn-warning"><i class="fa fa-search"> Tìm dịch vụ</i></button>
                        <h3><div id="service"></div></h3>
                     </div>
                  </div>
               </div>
            </div>
             <!-- {{--  ////////////////////////danh sách dịch vụ/////////////////////////  --}} -->

<div id="list_service_modal" class="modal fade">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Danh sách dịch vụ</h4>
      </div>
      <div class="modal-body">
       <form method="post" id="insert_form_service">
       <div class="pre-scrollable">
       <input type="text" id="search_service_actually" onkeyup="search_service()">
       <div id="list_service2">    
       
       </div>

        
       </form>
       </div>
      </div>
      <div class="modal-footer">
       <button type="button" data-dismiss="modal" id="insert_service" onClick="insert_service()" class="btn btn-success"> Chọn </button>
       <button type="button" class="btn btn-default" data-dismiss="modal"> Đóng </button>
      </div>
     </div>
    </div>
</div>
     <!-- {{--  ////////////////////////model/////////////////////////  --}} -->
     <!-- Simple pop-up dialog box containing a form -->
<dialog id="list_year_dialog">
  <form method="dialog">
    <p><label>Chọn năm:
      <select id="year_statistical">
        <option></option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
      </select>
    </label></p>
    <menu>
      <button>Hủy</button>
      <button onClick="fillter_report()">Xác nhận</button>
    </menu>
  </form>
</dialog>
{{--  --------------------------  --}}
                           

            <div class="row">
               <div class="col-lg-6">
                  <div class="inqbox ">
                     <div class="inqbox-title border-top-primary">
                        <h2> Tổng doanh thu</h2>
                     </div>
                     <div class="inqbox-content">
                     <center><h3>Chọn mốc thời gian</h3></center>
                        <center>
                        <tr>
                        <td><input type="month" style="width:200px;" id="from_date"></td> <Strong>To</strong> 
                        <td><input type="month" style="width:200px;" id="to_date"></td>
                        </tr>
                        <center>
                        <div class="hr-line-dashed"></div>      
                        <div><button onClick="fillter_total_service()" class="btn btn-primary">Tìm kiếm</button></div>
                        <div class="hr-line-dashed"></div>      
                        <form role="form" id="form">
                        <tr>
                        <td colspan="3"><center><h2><Strong style="color:blue;">Tổng doanh thu</strong></h2></center> </td>
                        </tr>
                        <div id="total_price">
                        <center><h2><Strong style="color:green;"><i class="fa fa-money"></i> 0 VND</strong></h2></center>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="inqbox ">
                     <div class="inqbox-title border-top-primary">
                        <h2>Thống kê</h2>
                     </div>
                     <div class="inqbox-content">
                        <h2>
                           <center><a onClick="list_year()"><i><img height="72px" src="{{asset ('backend/icon/Group 4514.svg')}}"></i></center></a>
                        </h2>
                        <div class="hr-line-dashed"></div>
                        <div id="title_report_year"><center><h2><strong style="color:blue;">Doanh thu trong năm </strong></h2></center></div>
                        <div class="hr-line-dashed"></div>
                       
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>Tháng </th>
                                 <th>Tiền</th>
                              </tr>
                           </thead>
                           <tbody>
                             
                      
                           </tbody>
                           <thead id="total_year">
             
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
function list_year()
{
   list_year_dialog.showModal();

}
function fillter_report()
{
  
   var id_service = $('#id_service').val();
   
    if(!id_service)
    {
       alert('Vui lòng chọn dịch vụ'); 
    }else{
   var year_statistical = $('#year_statistical').val();
   var title_report=`<center><h2><strong style="color:blue;">Doanh thu trong năm ${year_statistical}</strong></h2></center>`;
    $('#title_report_year').html(title_report);
   console.log(id_service);
   $.ajax({
        url: '{{URL::to('/statistical-service')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {id_service:id_service,year_statistical:year_statistical},
        dataType: 'json',
        success: function (response) 
        {         
         console.log(response);
         var total_year = 0;
         var output=``;
         response['total_moth'].forEach(function (item) {
         output+=`
            <tr>
               <td>${item.moth}</td>
               <td><i class="fa fa-money"></i> ${formatNumber(item.total_moth)} VND</td>
            </tr>`;
            total_year+=item.total_moth;
         });
         $('tbody').html(output);

         var total_year=`
         <tr><td colspan="2"><center><strong style="color:blue;"> Tổng doanh thu </strong></center></td></tr>
         <tr><td colspan="2"><center><strong style="color:green;"><i class="fa fa-money"></i> ${formatNumber(total_year)} VND </strong>
         </center></td></tr>`;
         $('#total_year').html(total_year);
         
        } 
        });  
    }
}
function fillter_total_service()
{
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   var id_service = $('#id_service').val();
   console.log(from_date);console.log(to_date);
   $.ajax({
        url: '{{URL::to('/fillter-total-service')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {from_date:from_date,to_date:to_date,id_service:id_service},
        dataType: 'json',
        success: function (response) 
        {  
         console.log(response);
         var output=``;
         output+=`<center><h2><Strong style="color:green;"><i class="fa fa-money"></i> ${formatNumber(response)} VND</strong></h2></center>`;
         $('#total_price').html('');
         $('#total_price').html(output);
        }
   });
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
                <th style="width:35px;"></th>
                <th>Tên dịch vụ</th>
                <th>Giá tiền</th>
                <th style="width:30px;"></th>
            </tr>`;
            $('#list_service2').html('');
            response.forEach(function (item) {
                //console.log(item);
                output+=`
                <tr>
                    <td style="width:35px;"></td>
                    <td class="project-title">
                        <p>${item.service}</p>  
                    </td>
                    <td class="project-title">
                        <p> ${formatNumber(item.price)} VND</p> 
                    </td>
                    <td class="project-title">
                   <p><button onClick="selected_service(${item.id})" class="btn btn-dark btn-sm" type="button" class="btn btn-default" data-dismiss="modal"> Chọn </button></p>  
                    </td>
                </tr>
                 `;
            });
            $('#list_service2').append(output); 
            
        }
    });
}
function selected_service(id)
{
   console.log(id);
   $.ajax({
        url: '{{URL::to('/edit-service-service')}}'+'/'+id,
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {
           console.log(response);   
           var output=`
           <tr><td><strong style="color:blue;">Tên dịch vụ: ${response[0].service}</strong></td></tr>
           <tr><td><strong style="color:black;">Giá : ${formatNumber(response[0].price)}</strong><input type="hidden" id="id_service" value="${response[0].id}">
           </td></tr>
           `;
           $('#service').html('');
           $('#service').html(output);
        }
   });
}
</script>