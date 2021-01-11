<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AuthModel;
class BillingController extends Controller
{
    public function all_billing()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
        $all_bill = DB::table('tbl_billing_billing')->orderby('id','desc')->get();
        //dd($all_bill);
        return view('admin.order_billing.billing_billing',compact('all_bill','permission'));
    }
    public function status_filter_billing(Request $request)
    {
        $stt = $request->billing_status;
        $data = DB::table('tbl_billing_billing')->where('billing_status',$stt)->get();
        //dd($data);
        if(isset($data))
        {
        return json_encode($data); 
        }else{
            $all_data = DB::table('tbl_billing_billing')->get();   
            return json_encode($all_data); 
        }
    }
    public function order_billing_detail($id)
    {

        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
         $data = DB::table('tbl_billing_billing')    
      //  ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.id',$id)
        ->get();
      //  dd($data);
       // return json_encode($data); 
        return view('admin.order_billing.order_billing_detail',compact('data','permission'));
    }
    public function cancel_bill($id,Request $request)
    {  
        if($request->billing_comment=='')
        {
        $mes['mes']='Vui lòng điền lý do !';
        return json_encode($mes);   
        }
        $data = array();
        $data['billing_status']= 5;
        $data['billing_comment']=$request->billing_comment;
        DB::table('tbl_billing_billing')->where('id',$id)->update($data);      
        $mes['mes']='Hủy đơn hàng thành công !';
        return json_encode($mes);  
    }
    public function add_appointment(Request $request)
    {
        $flag=0;
        $data = array();
        $arraylich=isset($request->arrlich1)?$request->arrlich1:array();
        foreach($arraylich as $v){
        if($v['starttime']!='' && $v['finishtime']!='')
            $flag =1; }

        if($flag == 1)
        {
            foreach($arraylich as $v)
            {
                if($v['starttime']!='' && $v['finishtime']!='')
                {
                $data['id_service_service']=$v['id'];   
                $data['id_billing']=$request->id;
                $data['appointment_time']=$v["starttime"]." - ".$v["finishtime"];
                DB::table('tbl_billing_appointment')->insert($data);
                }
            }    
            $mes['mes']='Đặt lịch thành công !';
            return json_encode($mes);          
        }else{
            $mes['mes']='Vui lòng điền tối thiểu 1 !';
            return json_encode($mes);     
        }
        
    }
    public function update_billing_date_time(Request $request)
    {
        $data = array();
        $data['billing_date']=$request->billing_date;
        $data['billing_time']=$request->billing_time;
        DB::table('tbl_billing_billing')->where('id',$request->id_billing)->update($data);
        $date_time= DB::table('tbl_billing_billing')->where('id',$request->id_billing)->get();
        return json_encode($date_time);
    }
    public function save_billing_acctually(Request $request)
    {
        $data=array();
        $arr = $request->arrayservice;
        if($arr=='')
        {
            $mes['mes']='Chọn tối thiểu một dịch vụ';
            return json_encode($mes);    
        }else{
            foreach($arr as  $k => $v) 
            {   
                $price = DB::table('tbl_service_service')->where('id',$v)->get();
                $data['id_service']=$v;
                $data['id_billing']=$request->id_billing;
                $data['billing_price']=$price[0]->price;
                DB::table('tbl_billing_actually')->insert($data); 
            }
            $param = DB::table('tbl_billing_actually')    
            ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_actually.id_billing')
            ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
            ->where('tbl_billing_actually.id_billing',$request->id_billing)
            ->select('service','price','billing_quantity','id_billing','id_service')
            ->get();
          
            return json_encode($param);    
        }
    }
    public function search_bill(Request $request)
    {
        $keywork = $request->result;
        if($keywork =='')
        {
            $data = DB::table('tbl_billing_billing')->orderby('id','desc')->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_billing_billing')->where('billing_code', 'LIKE', "%{$keywork}%")->get();
            return json_encode($data);
        }
    }


    
}
