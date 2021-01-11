@extends('dashboard')
@section('admin_content') 

    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
  
        <div class="row">
            <div class="tabs-container">
            
                <div class="tab-content">
                <div>
                    <div class="panel-body">
                    <!-- Simple pop-up dialog box containing a form -->
                    <dialog id="favDialog_staff">
                    <form method="dialog">
                        <p><label>
                        <tr><td>
                        Bạn có muốn đăng xuất tài khoản nhân viên
                        trong ứng dụng này không ?
                        </td></tr>
                        </label></p>
                        <center>
                            <menu>
                            <button>Từ chối</button>
                            <button onClick="force_sign_out_staff()">Đồng ý</button>
                            </menu>
                        </center>
                    </form>
                    </dialog>
                    {{--  force customer   --}}
                    <div class="panel-body">
                    <!-- Simple pop-up dialog box containing a form -->
                    <dialog id="favDialog_customer">
                    <form method="dialog">
                        <p><label>
                        <tr><td>
                        Bạn có muốn đăng xuất tài khoản khách hàng
                        trong ứng dụng này không ?
                        </td></tr>
                        </label></p>
                        <menu>
                        <button>Từ chối</button>
                        <button onClick="force_sign_out_customer()">Đồng ý</button>
                        </menu>
                    </form>
                    </dialog>

                   
                 
                          
                        <center><i><img src="{{asset ('backend/icon/Group 4784.png')}}"></i><center>
              
                       <a id="staff"><i><img src="{{asset ('backend/icon/out staff.svg')}}"></i></a>
                        <a id="customer"><i><img src="{{asset ('backend/icon/out customer.svg ')}}"></i></a>
                      
                    </div>
                </div>
                
                
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script>
(function() {
  var updateButton = document.getElementById('staff');
  var favDialog = document.getElementById('favDialog_staff');

  // “Update details” button opens the <dialog> modally
  updateButton.addEventListener('click', function() {
    favDialog.showModal();
  });
})();
function force_sign_out_staff()
{
    $.ajax({
        url: '{{URL::to('/force-sign-out-staff')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);
        }
    });

}
(function() {
  var updateButton = document.getElementById('customer');
  var favDialog = document.getElementById('favDialog_customer');

  // “Update details” button opens the <dialog> modally
  updateButton.addEventListener('click', function() {
    favDialog.showModal();
  });
})();
function force_sign_out_customer()
{
    $.ajax({
        url: '{{URL::to('/force-sign-out-customer')}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        success: function (response) 
        {
            alert(response['mes']);
        }
    });    
}
</script>

 @endsection 
