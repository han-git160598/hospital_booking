<?php

use Illuminate\Support\Facades\Route;
use App\AuthModel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    Session::put('full_name',null);
    Session::put('email',null);
    Session::put('id',null);
    return view('login');
});
Route::get('/login-admin','LoginController@login_admin');
Route::get('/logout-admin','LoginController@logout_admin');
Route::get('/dashboard',function()
{
    $model = new AuthModel;
    $model->AuthLogin();
    return view('/dashboard');
});
//  QL service_service---------------------------------------------------------------------
Route::get('/all-service-service','ServiceController@allservice_service');
Route::get('/add-service-service',function() {
    $model = new AuthModel;
    $model->AuthLogin();
    return view('admin.addservice_service');
});
Route::get('/save-service-service','ServiceController@saveservice_service');
Route::get('/delete-service-service/{id}','ServiceController@deleteservice_service');
Route::get('/edit-service-service/{id}','ServiceController@editservice_service');
Route::get('/update-service-service/{id}','ServiceController@updateservice_service');
Route::get('/disable-service-service/{id}','ServiceController@disable_service');
Route::get('/enable-service-service/{id}','ServiceController@enable_service');
Route::get('/disable-service-service','ServiceController@all_disable_service');

Route::post('/search-service-service','ServiceController@search_service_service');

//QL service_packet
Route::get('/all-service-packet','ServicePacketController@all_service_packet');
Route::get('/list-service-service','ServicePacketController@listservice_service');
Route::get('/select-list-service','ServicePacketController@select_list');

Route::post('/list-service-packet-detail','ServicePacketController@list_service_packet_detail');
Route::get('/save-service-packet','ServicePacketController@save_service_packet');
Route::get('/edit-service-packet/{id}','ServicePacketController@edit_service_packet');
Route::post('update-service-packet','ServicePacketController@update_service_packet');
Route::post('/delete-service-packet','ServicePacketController@delete_service_packet');

Route::post('/remove-service-packet-detail','ServicePacketController@remove_service_packet_detail');
Route::post('/list-service-in-packet','ServicePacketController@list_service_in_packet');
// update service_packet_detail
Route::post('/update-service-packet-detail','ServicePacketController@update_service_packet_detail');

// QL bài đăng---------------------------------------------------------------------
Route::get('/news',function()
{
    $id_admin = Session::get('id');
    if($id_admin){
    $stt = 'Y';
    $all_news = DB::table('tbl_news')->orderby('id','desc')->get();
    return view('admin.news',compact('all_news'));}
    else{
    return Redirect::to('/login-admin');
}
});
Route::get('/save-news','NewsController@save_news');
Route::get('/delete-news/{id}','NewsController@delte_news');
Route::get('/edit-news/{id}','NewsController@edit_news');
Route::get('/update-news/{id}','NewsController@update_news');
Route::get('/disable-news/{id}','NewsController@disable_news');
Route::get('/enable-news/{id}','NewsController@enable_news');

Route::post('/search-news','NewsController@search_news');
// QL khách hàng---------------------------------------------------------------------
Route::get('/all-account-customer','AccountCustomerController@all_account_customer');
Route::get('/save-account-customer','AccountCustomerController@save_account_customer');
Route::get('/delete-account-customer/{id}','AccountCustomerController@delete_account_customer');
Route::get('/edit-account-customer/{id}','AccountCustomerController@edit_account_customer');
Route::get('/update-account-customer/{id}','AccountCustomerController@update_account_customer');

Route::post('/search-account-customer','AccountCustomerController@search_account_custome');


Route::get('/history-account-customer/{id}','AccountCustomerController@all_history_account_customer');
Route::get('/detail-order-customer/{id}','AccountCustomerController@detail_order_customer');
Route::get('/service-detail/{id}','AccountCustomerController@service_detail');
Route::get('/customer-detail/{id}','AccountCustomerController@customer_detail');
Route::get('/actually-detail/{id}','AccountCustomerController@actually_detail');
Route::get('/billing-detail/{id}','AccountCustomerController@billing_detail');
Route::get('/appointment-detail/{id}','AccountCustomerController@appointment_detail');




// QL Slide
Route::get('/all-slide','SlideController@all_slide');
Route::get('/save-slide','SlideController@save_slide');
Route::get('/delete-slide/{id}','SlideController@delete_slide');
Route::get('/edit-slide/{id}','SlideController@edit_slide');
Route::get('/update-slide/{id}','SlideController@update_slide');

//QL Account type
Route::get('/all-account-type','AccountTypeController@all_account_type');
Route::get('/save-account-type','AccountTypeController@save_account_type');
Route::get('/delete-account-type/{id}','AccountTypeController@delete_account_type');
Route::get('/edit-account-type/{id}','AccountTypeController@edit_account_type');
Route::get('/update-account-type/{id}','AccountTypeController@update_account_type');

//QL Account Premission
Route::get('/all-account-permission','AccountPermissionController@all_account_permission');
Route::get('/save-account-permission','AccountPermissionController@save_account_permission');
Route::get('/delete-account-permission/{id}','AccountPermissionController@delete_account_permission');
Route::get('/edit-account-permission/{id}','AccountPermissionController@edit_account_permission');
Route::get('/update-account-permission/{id}','AccountPermissionController@update_account_permission');

Route::POST('/search-account-permission','AccountPermissionController@search_account_permission');

// QL bill
Route::get('/all-billing','BillingController@all_billing');

Route::post('/search-bill','BillingController@search_bill');
Route::get('/status-filter-billing','BillingController@status_filter_billing');
Route::get('/order-billing-detail/{id}','BillingController@order_billing_detail');
Route::get('/cancel-bill/{id}','BillingController@cancel_bill');
Route::get('/add-appointment','BillingController@add_appointment');
Route::get('/update-billing-date-time','BillingController@update_billing_date_time');

// Acctually

Route::post('/save-billing-actually','BillingController@save_billing_acctually');

//Account admin///////////////////////////////////////////
Route::get('/all-account-admin','AccountAdminController@all_account_admin');
Route::get('/disable-account-admin/{id}','AccountAdminController@disable_account_admin');
Route::get('/enable-account-admin/{id}','AccountAdminController@enable_account_admin');
Route::get('/account-admin-detail/{id}','AccountAdminController@account_admin_detail');

Route::get('/list-account-permission','AccountAdminController@list_account_permission');

Route::post('/save-account-authorize','AccountAdminController@save_account_authorize');
Route::post('/reset-password-admin','AccountAdminController@reset_password_admin');
Route::post('/remove-authorize-admin','AccountAdminController@remove_authorize_admin');
Route::get('/list-account-type','AccountAdminController@list_account_type');

Route::post('/save-account-admin','AccountAdminController@save_account_admin');
Route::post('/delete-account-admin','AccountAdminController@delete_account_admin');

Route::post('/update-account-admin','AccountAdminController@update_account_admin');
//// /force-sign-out
Route::get('/force-sign-out',function(){
    $id = Session::get('id');
    $permission = DB::table('tbl_account_admin')
    ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
    ->where('tbl_account_admin.id',$id)
    ->select('tbl_account_admin.id','type_account')
    ->get();
    if($permission[0]->type_account == 'Admin')
    {
        return view('admin.force_sign_out');
    }else{
        $mes['mes']='Bạn không có quyền nè!';
        return Redirect::to('/dashboard');
    }   
});
Route::post('/force-sign-out-staff','ForceSignOutController@force_sign_out_staff');
Route::post('/force-sign-out-customer','ForceSignOutController@force_sign_out_customer');

//test
Route::get('/test',function (){
	return view('admin.filetest');
});