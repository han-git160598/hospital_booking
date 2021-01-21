@extends('dashboard')
@section('admin_content') 
      <div style="clear: both; height: 61px;"></div>
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <div class="inqbox float-e-margins">
                     <div class="inqbox-content">
                        <h2>Báo cáo thông kê khách hàng </h2>
                     </div>
                  </div>
               </div>
            </div>
                           
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
                        <div><button onClick="fillter_total_serrvi()" class="btn btn-primary">Tìm kiếm</button></div>
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
                           <center><a onClick="list_service()"><i><img src="{{asset ('backend/icon/Group 4514.svg')}}"></i></center></a>
                        </h2>
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
function title_report()
{
   list_year_dialog.showModal();
}
function fillter_report()
{
   $.ajax({
      url: '{{URL::to('/statistical-service')}}',
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {year_statistical:year_statistical},
      dataType: 'json',
      success: function (response) 
      {         
      console.log(response);
      }
      });   
}
function fillter_total()
{
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   console.log(from_date);console.log(to_date);
   $.ajax({
        url: '{{URL::to('/fillter-total-service')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {from_date:from_date,to_date:to_date},
        dataType: 'json',
        success: function (response) 
        {  
         console.log(response);
        
        }
   });
}
</script>