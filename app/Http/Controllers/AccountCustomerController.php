<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AccountCustomerController extends Controller  
{
    public function all_account_customer()
    {
       // dd(123);
        $all_account_customer = DB::table('tbl_account_customer')
        //->join('tbl_billing_billing','tbl_billing_billing.id_customer','=','tbl_account_customer.id')
        //->select(DB::raw('count(*) as total, id_customer'))
        //->orderby('tbl_account_customer.id','desc')
       // ->groupBy('id_customer')
        ->get();
         //dd($all_account_customer);    
        return view('admin.account_customer',compact('all_account_customer'));
    }
    public function save_account_customer(Request $request)
    {  
        
        if($request->allFiles()=='')
        {
        $mes['mes']='Không được bỏ trống !';
        return json_encode($mes);     
        }
        $checkphone = DB::table('tbl_account_customer')->where('phone_active',$request->phone_active)->count();
        if($checkphone>0 )
        {
        $mes['mes']='SDT đã tồn tại';
        return json_encode($mes);   
        }
        $data =array();
        $data['phone_active']= $request->phone_active;
        $data['full_name']= $request->full_name;
        $data['birthday']= $request->birthday;
        $data['sex']= $request->sex;
        $data['address']= $request->address;
        $data['phone_number']= $request->phone_number;
        $data['email']= $request->email;
        $data['password']= md5($request->password);
        $data['force_sign_out']= '0';
        DB::table('tbl_account_customer')->insert($data);
        $mes['mes']='Thêm thành công!';
        return json_encode($mes);   
    }
    public function delete_account_customer($id)
    {
        DB::table('tbl_account_customer')->where('id',$id)->delete();
        $data = DB::table('tbl_account_customer')->orderby('id','desc')->get();
        return json_encode($data);
    }
    public function edit_account_customer($id)
    {
        $data=DB::table('tbl_account_customer')->where('id',$id)->get();
        return json_encode($data);
    }
    public function update_account_customer(Request $request, $id)
    {
        if($request->allFiles()=='')
        {
        $mes['mes']='Không được bỏ trống !';
        return json_encode($mes);     
        }
        $data =array();
        $data['full_name']= $request->full_name;
        $data['birthday']= $request->birthday;
        $data['sex']= $request->sex;
        $data['address']= $request->address;
        $data['phone_number']= $request->phone_number;
        $data['email']= $request->email;
        $data['password']= md5($request->password);
        $data['force_sign_out']= '0';
        DB::table('tbl_account_customer')->where('id',$id)->update($data);
        $mes['mes']='Cập nhật thành công!';
        return json_encode($mes);   
    }

    public function all_history_account_customer($id)
    {
       $data =  DB::table('tbl_billing_billing')
        //->join('tbl_account_customer','tbl_account_customer.id','=','tbl_billing_billing.id_customer')
       // ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        //->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
        ->where('tbl_billing_billing.id_customer',$id)->get();        
        //dd($data);  
        return json_encode($data);
    }
    public function detail_order_customer($id)
    {
       $data = DB::table('tbl_billing_billing')    
       // ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')
        //->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
       // ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
       // ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('tbl_billing_billing.id',$id)->get();     
       //dd($data);
       return view('admin.billing_detail',compact('data'));
            

    }
    public function service_detail($id)
    {
        $data = DB::table('tbl_billing_billing')    
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')    
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
        ->where('tbl_billing_detail.id_billing',$id)->get();
      //  dd($data);
        return json_encode($data);
    }
    public function customer_detail($id)
    {
        $data = DB::table('tbl_billing_billing')    
        ->join('tbl_billing_customer','tbl_billing_customer.id_billing','=','tbl_billing_billing.id')    
        ->where('tbl_billing_customer.id_billing',$id)
        ->get();   
        return json_encode($data); 
    }
    public function actually_detail($id)
    {
        $data = DB::table('tbl_billing_actually')    
        ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_actually.id_billing')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('tbl_billing_actually.id_billing',$id)
        ->get();
        return json_encode($data);
    }
    public function billing_detail($id)
    {
        $data = DB::table('tbl_billing_billing')    
      //  ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')    
        ->where('tbl_billing_billing.id',$id)
        ->get();   
      //  dd($data);
        return json_encode($data);     
    }

    
    
}
