<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AuthModel;
class AccountCustomerController extends Controller  
{
    public function all_account_customer()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        // dd(123);
        $permission=$model->permission();
        $all_account_customer = DB::table('tbl_account_customer')
        //->join('tbl_billing_billing','tbl_billing_billing.id_customer','=','tbl_account_customer.id')
        //->select(DB::raw('count(*) as total, id_customer'))
        //->orderby('tbl_account_customer.id','desc')
        // ->groupBy('id_customer')
        ->orderby('id','desc')
        ->get();
            //dd($all_account_customer);    
        return view('admin.account_customer',compact('all_account_customer','permission'));
    }
    public function save_account_customer(Request $request)
    {  
        
        $checkphone = DB::table('tbl_account_customer')->where('phone_active',$request->phone_active)->count();
        if($checkphone>0 )
        {
        $mes['mes']='Số điện thoại này đã được đăng ký trước đó';
        return json_encode($mes);   
        }
        $data =array();
        $data['phone_active']= $request->phone_active;
        $data['full_name']= $request->full_name;
        $data['birthday']= $request->birthday;
        $data['sex']= $request->sex;
        $data['address']= $request->address;
        $data['nationality']= $request->nationality;
        $data['phone_number']= $request->phone_number;
        $data['email']= $request->email;
        $data['password']= md5($request->password);
        // $data['force_sign_out']= '0';
        DB::table('tbl_account_customer')->insert($data);
        $mes['mes']='Thêm thành công!';
        return json_encode($mes);   
    }
    public function delete_account_customer(Request $request)
    {

        $check = DB::table('tbl_billing_billing')->where('id_customer',$request->id)->get();
        if(count($check)>0)
        {
            $data['mes']='Không thể xóa khách hàng này vì đã có đơn hàng';
            return json_encode($data);
        }
        DB::table('tbl_account_customer')->where('id',$request->id)->delete();
        $data['customer'] = DB::table('tbl_account_customer')->orderby('id','desc')->get();
        $data['mes']= 'sucsses';
        return json_encode($data);
    }
    public function edit_account_customer($id)
    {
        $data=DB::table('tbl_account_customer')->where('id',$id)->get();
        return json_encode($data);
    }
    public function search_account_custome(Request $request)
    {
        $keywork = $request->result;
        if($keywork =='')
        {
            $data = DB::table('tbl_account_customer')->orderby('id','desc')->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_account_customer')
            ->where('full_name', 'LIKE', "%{$keywork}%")
            ->orWhere('phone_active', 'LIKE', "%{$keywork}%")
            ->orWhere('address', 'LIKE', "%{$keywork}%")
            ->get();
            return json_encode($data);
        }
    }
    public function update_account_customer(Request $request, $id)
    {
        if( $request->full_name == '' || $request->address==''  )
        {
            $mes['mes']='Không được bỏ trống các trường có kí hiệu (*) !';
            return json_encode($mes);     
        }
        $data =array();
        $data['full_name']= $request->full_name;
        $data['birthday']= $request->birthday;
        $data['sex']= $request->sex;
        $data['address']= $request->address;
        $data['phone_number']= $request->phone_number;
        $data['email']= $request->email;
        $data['nationality']= $request->nationality;
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
        $model = new AuthModel; 
        $model->AuthLogin();
        $permission=$model->permission();

        $data['document'] = DB::table('tbl_billing_billing')    
        ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.id',$id)
        ->select('image_upload')
        ->orderby('tbl_billing_document.id','desc')
        ->get();
     // dd( $data['document'])
        $data['billing'] = DB::table('tbl_billing_billing')    
       //  ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        // ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')
        //->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
       // ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
       // ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('id',$id)->get();     
       //dd($data);
       return view('admin.billing_detail',compact('data','permission'));
            

    }
    public function service_detail(Request $request)
    {
        $total = DB::table('tbl_billing_detail')->where('id_billing',$request->id)
        ->select([DB::raw("SUM(billing_price) as total_service")])
        ->groupBy('id_billing')
        ->get()
        ->toArray();
        $total1 = DB::table('tbl_billing_customer')->where('id_billing',$request->id)
        ->count();
        $total_per=$total1; // số người
        $total_service = $total[0]->total_service; //tổng dịch vụ
        $initial_total = $total_service * $total_per; // thành tiền

        $data['service'] = DB::table('tbl_billing_billing')    
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')    
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
        ->where('tbl_billing_detail.id_billing',$request->id)
        //->select('id_service','service','tbl_billing_billing.id_billing','tbl_service_service.id')
        ->get();
        $data['initial_total']=$initial_total;
        $data['total_person']=$total_per=$total1;
        //dd($data);
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
    public function actually_detail(Request $request)
    {
      
        $total = DB::table('tbl_billing_actually')->where('id_billing',$request->id)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing')
        ->get()
        ->toArray(); //total_actually
     //   dd($total);
        if(empty($total))
        {
        $data= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id)
        ->select([DB::raw("SUM(billing_price) as total_service")])
        ->groupBy('id_billing')
        ->get();
         $total_billing =$data[0]->total_service ;
        }else{
        $data= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id)
        ->select([DB::raw("SUM(billing_price) as total_service")])
        ->groupBy('id_billing')
        ->get();
         $total_billing = $total[0]->total_actually + $data[0]->total_service ; 
        }
        ///////////////////////////////////////////////////////////////////////
        // $total =  DB::table('tbl_billing_actually')
        // ->where('id_billing',$request->id_billing)
        // ->groupby('billing_price')->sum('billing_price') ->select('id_billing');

        $data['service'] = DB::table('tbl_billing_actually')    
        ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_actually.id_billing')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('tbl_billing_actually.id_billing',$request->id)
        ->select('service','billing_price','billing_quantity','id_service','id_billing','price')
        ->get();
        $data['total'] = DB::table('tbl_billing_actually')->where('id_billing',$request->id)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing')
        ->get();
        $data['total_billing']=$total_billing;

        
        return json_encode($data);
            
    }
    public function billing_detail(Request $request)
    {
        $data = DB::table('tbl_billing_billing')    
      //  ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')    
        ->where('tbl_billing_billing.id',$request->id)
        ->get();   
     
        return json_encode($data);     
    }
    public function reset_password_customer(Request $request)
    {
        if($request->pass_customer== '')
        {
        $mes['mes']='Vui lòng không để trống !';
        return json_encode($mes);    
        }
        if(strlen($request->pass_customer) < 6)
        {
        $mes['mes']='Mật khẩu phải tối thiểu 6 kí tự ';
        return json_encode($mes);  
        }
        $data= array();
        $data['password']=md5($request->pass_customer);
        DB::table('tbl_account_customer')->where('id',$request->id_customer)->update($data);
        $mes['mes']='Thay đổi mật khẩu thành công !';
        return json_encode($mes);
    }
    

    
    
}
