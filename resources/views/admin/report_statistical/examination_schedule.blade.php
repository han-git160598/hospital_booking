@extends('dashboard')
@section('admin_content') 
      <div style="clear: both; height: 61px;"></div>
         <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
               <div class="col-lg-12">
                  <div class="inqbox float-e-margins">
                     <div class="inqbox-content">
                        <h2>Báo cáo thông kê lịch khám</h2>
                        
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
        <option value="2029">2039</option>
      </select>
    </label></p>
    <menu>
      <button>Hủy</button>
      <button onClick="filter_report()">Xác nhận</button>
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
                     <center>
                        <h2>
                           Chọn mốc thời gian
                        </h2>
                     </center>
                         <center>
                        <tr>
                        <td><input type="month" style="width:160px;" id="from_date"></td> <Strong>To</strong> 
                        <td><input type="month" style="width:160px;" id="to_date"></td>
                        <td><button onClick="fillter_total()" class="btn btn-primary">Tìm kiếm</button></td>
                        </tr>
                        <center>
                        <div class="hr-line-dashed"></div>      
                        <form role="form" id="form">
       
                        <tr>
                        <td colspan="3"><center><h2><Strong style="color:blue;">Tổng doanh thu</strong></h2></center> </td>
                        <td colspan="3"><center><h2><Strong style="color:green;">$3000000</strong></h2></center> </td>
                        </tr>
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
                           <center><a onClick="list_year()"><i><img src="{{asset ('backend/icon/Group 4514.svg')}}"></i></center></a>
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
function list_year()
{
   list_year_dialog.showModal();

}
function filter_report()
{
   var year_statistical = $('#year_statistical').val();
   $.ajax({
        url: '{{URL::to('/fillter-year-statistical')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {year_statistical:year_statistical},
        dataType: 'json',
        success: function (response) 
        {         
         var total_year = 0;
         console.log(response);
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
function fillter_total()
{
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   console.log(from_date);console.log(to_date);
   $.ajax({
        url: '{{URL::to('/fillter-total-examination-schedule')}}',
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