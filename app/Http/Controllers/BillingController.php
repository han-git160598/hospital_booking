<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\AuthModel;
class BillingController extends Controller
{
    public function all_billing()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission(); 
        $all_bill = DB::table('tbl_billing_billing')->orderby('id','desc')->get();
     //   dd($all_bill);
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
        $total = DB::table('tbl_billing_actually')->where('id_billing',$id)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing')
        ->get()
        ->toArray(); //total_actually
     //   dd($total);
        if(empty($total))
        {
        $data= DB::table('tbl_billing_detail')    
        ->where('id_billing',$id)
        ->select([DB::raw("SUM(billing_price) as total_service")])
        ->groupBy('id_billing')
        ->get();
         $total_billing =$data[0]->total_service ;
        }else{
        $data= DB::table('tbl_billing_detail')    
        ->where('id_billing',$id)
        ->select([DB::raw("SUM(billing_price) as total_service")])
        ->groupBy('id_billing')
        ->get();
         $total_billing = $total[0]->total_actually + $data[0]->total_service ; 
        }
        //   dd($total_billing);
        $a = $id;
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
        $id = session::get('id');
        //  dd($a);
        $data['document'] = DB::table('tbl_billing_billing')    
        ->join('tbl_billing_document','tbl_billing_document.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.id',$a)
        ->select('image_upload','tbl_billing_document.id_billing','tbl_billing_document.id')
        ->orderby('tbl_billing_document.id','desc')
        ->get();

        $data['billing'] = DB::table('tbl_billing_billing')    
        ->where('tbl_billing_billing.id',$a)
        ->get();
        return view('admin.order_billing.order_billing_detail',compact('data','permission','total_billing'));
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
    public function appointment_detail(Request $request) 
    {
        $data['service'] = DB::table('tbl_billing_detail')    
        ->leftjoin('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_detail.id_billing')
        ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
        ->where('tbl_billing_billing.id',$request->id)
        ->select('service','tbl_service_service.id','tbl_billing_detail.id_billing')
        ->get();

        $data['appointment'] = DB::table('tbl_billing_appointment')    
        ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_billing_appointment.id_service_service')
        ->leftjoin('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_appointment.id_billing')
        ->where('tbl_billing_billing.id',$request->id)
        ->select('service','tbl_billing_appointment.id_billing','tbl_billing_appointment.id_service_service','appointment_time')
        ->get();
        
        $check = count($data['appointment']);
        if($check > 0 )
        {
            $data['service'] = DB::table('tbl_billing_appointment')    
            ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_billing_appointment.id_service_service')
            ->leftjoin('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_appointment.id_billing')
            ->where('tbl_billing_appointment.id_billing',$request->id)
            ->select('service','tbl_billing_appointment.id_billing','tbl_service_service.id','appointment_time')
            ->get(); 
            return json_encode($data);
        }


      // dd($data);
        return json_encode($data);
    }
    public function add_appointment(Request $request)
    {
        
        $flag=0;
        $data = array();
        $arraylich=isset($request->arrlich1)?$request->arrlich1:array();
        foreach($arraylich as $v)
        {
        if($v['starttime'] =='' || $v['finishtime'] =='')
            $flag =1;
        }
        if($flag == 1)
        {
            $mes['mes']='Không được bỏ trống !';
            return json_encode($mes);          
        }else{
            
            foreach($arraylich as $v)
            {   
                $check = DB::table('tbl_billing_appointment')->where('id_billing',$request->id)
                ->where('id_service_service',$v['id'])->count();
                if($check == 0)
                {
                    if($v['starttime']!='' && $v['finishtime']!='')
                    {
                    $data['id_service_service']=$v['id'];   
                    $data['id_billing']=$request->id;
                    $data['appointment_time']=$v["starttime"]." - ".$v["finishtime"];
                    DB::table('tbl_billing_appointment')->insert($data);
                    }
                }else{
                    $data['id_service_service']=$v['id'];   
                    $data['id_billing']=$request->id;
                    $data['appointment_time']=$v["starttime"]." - ".$v["finishtime"];
                    DB::table('tbl_billing_appointment')->where('id_billing',$request->id)
                    ->where('id_service_service',$v['id'])->update($data);
                    $mes['mes']=' Thay đổi lịch khám thành công !';
                    return json_encode($mes);
                }
            }    
            $mes['mes']=' Tạo lịch khám khám thành công !';
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
        foreach($arr as  $k => $v) 
        {   
            $price = DB::table('tbl_service_service')->where('id',$v)->get();
            $data['id_service']=$v;
            $data['id_billing']=$request->id_billing;
            $data['billing_price']=$price[0]->price;
            DB::table('tbl_billing_actually')->insert($data); 
        }
        $param['service'] = DB::table('tbl_billing_actually')    
        ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_actually.id_billing')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('tbl_billing_actually.id_billing',$request->id_billing)
        ->get();
        $param['total'] = DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_actually")])->groupBy('id_billing')->get();
        //// total_billing //////////////////////
        $total_actually = DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing')->get()->toArray(); //total_actually
        if(empty($total_actually))
        {
        $total_service= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
         $total_billing =$data[0]->total_service ;
        }else{
        $total_service= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
         $total_billing = $total_actually[0]->total_actually + $total_service[0]->total_service ; 
        }
        ///////////////////////////////////////////////////////////////////////
        $param['total_biliing']=$total_billing;
        $param['mes']='Thêm dịch vụ phát sinh thành công';
        return json_encode($param);    
        
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
    public function remove_service_actually(Request $request)
    {
        DB::table('tbl_billing_actually')->where('id_service',$request->id_service)
        ->where('id_billing',$request->id_billing)->delete();

        $data['service'] = DB::table('tbl_billing_actually')    
        ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_actually.id_billing')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
        ->where('tbl_billing_actually.id_billing',$request->id_billing)->get();
        $data['total'] = DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing') ->get();

         //// total_billing //////////////////////
         $total_actually = DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
         ->select([DB::raw("SUM(billing_price) as total_actually")])
         ->groupBy('id_billing')->get()->toArray(); //total_actually
         
         if(empty($total_actually))
         {
         $total_service= DB::table('tbl_billing_detail')    
         ->where('id_billing',$request->id_billing)
         ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
        $total_billing =$total_service[0]->total_service ;
         }else{
         $total_service= DB::table('tbl_billing_detail')    
         ->where('id_billing',$request->id_billing)
         ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
          $total_billing = $total_actually[0]->total_actually + $total_service[0]->total_service ; 
         }
         ///////////////////////////////////////////////////////////////////////
         $data['total_biliing']=$total_billing;
        return json_encode($data);
    }

    public function update_status_bill(Request $request)
    {
        $status  = DB::table('tbl_billing_billing')->where('id',$request->id)->get();
        $a = $status[0]->billing_status;
        $payed = DB::table('tbl_billing_billing')->where('id',$request->id)->get();
        $payment_type= DB::table('tbl_billing_billing')->where('id',$request->id)->get();
      //  return json_encode(count($payed));
      
      
        if($payment_type[0]->payment_type == 2)
        {
            if($payed[0]->payment_image == NULL)
            {
                $message['img']='not_img';
                $message['mes']='Vui lòng thêm hình ảnh thanh toán trước khi xác nhận';
                return json_encode($message);   
            }
            if($a < 2 ){
            $data = array();
            $data['billing_status']=$a+2;
            DB::table('tbl_billing_billing')->where('id',$request->id)->update($data);
            $message['data']=DB::table('tbl_billing_billing')->where('id',$request->id)->select('billing_status')->get();
            $message['mes']='Cập nhật trạng thái hóa đơn thành công';
            return json_encode($message);
            }elseif($a == 3 )
            {
            $data = array();
            $data['billing_status']=$a+1;
            DB::table('tbl_billing_billing')->where('id',$request->id)->update($data);
            $message['data']=DB::table('tbl_billing_billing')->where('id',$request->id)->select('billing_status')->get();
            $message['mes']='Cập nhật trạng thái hóa đơn thành công';
            return json_encode($message); 
            }
        }else{
            if($a == 1 )
            {
            $data = array();
            $data['billing_status']=$a+1;
            DB::table('tbl_billing_billing')->where('id',$request->id)->update($data);
            $message['data']=DB::table('tbl_billing_billing')->where('id',$request->id)->select('billing_status')->get();
            $message['mes']='Cập nhật trạng thái hóa đơn thành công';
            return json_encode($message);
            }
            elseif($a == 2 ){
            $data = array();
            $data['billing_status']=$a+2;
            DB::table('tbl_billing_billing')->where('id',$request->id)->update($data);
            $message['data']=DB::table('tbl_billing_billing')->where('id',$request->id)->select('billing_status')->get();
            $message['mes']='Cập nhật trạng thái hóa đơn thành công';
            return json_encode($message);
            }

        }
    }
    public function add_prehistoric(Request $request)
    {
        $data = array();
        $check = DB::table('tbl_billing_customer')
        ->where('id',$request->id)
        ->where('prehistoric',$request->prehistoric)
        ->get();    
        if(count($check) > 0)
        {
            $data['prehistoric']=$request->content;
            DB::table('tbl_billing_customer')->where('id',$request->id)->update($data);
          
        }else{
            $data['prehistoric']=$request->content;
            DB::table('tbl_billing_customer')->where('id',$request->id)->update($data);
        }
        $content = $request->content;
        return json_encode($content);
     
    } 
    public function save_billing_document(Request $request)
    {   
        $image = $request->file('img_billing_document');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move('../../images/billing_document', $new_name);
        $url='images/billing_document/'.$new_name;
        $data = array();
        $data['id_billing']=$request->id_billing;
        $data['image_upload']=$url;
       
        DB::table('tbl_billing_document')->insert($data);
        $mes['mes']='Thêm hình ảnh thành công';
        $mes['data'] = DB::table('tbl_billing_document')->where('id_billing',$request->id_billing)->get();
        return json_encode($mes); 
    }
    public function remove_img_document(Request $request)
    {
        $image_path = DB::table('tbl_billing_document')->where('id',$request->id)->get();
        DB::table('tbl_billing_document')->where('id',$request->id)->delete();
        if (file_exists('../../'. $image_path[0]->image_upload)) {
            @unlink('../../'. $image_path[0]->image_upload);
        }
        $data['mes']='Xóa hình ảnh thành công';
        $data['data']=DB::table('tbl_billing_document')->where('id_billing',$request->id_billing)->get();
        return json_encode($data);
    }
    public function save_img_payment(Request $request)
    {
        $payed = DB::table('tbl_billing_billing')->where('id',$request->id_billing)->get();
        $image = $request->file('img_payment');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move('../../images/payment_image/', $new_name);
        $url='images/payment_image/'.$new_name;
        $data = array();    
        $data['payment_image']=$url;
        DB::table('tbl_billing_billing')->where('id',$request->id_billing)->update($data);
        if (file_exists('../../'. $payed[0]->payment_image)) {
            @unlink('../../'. $payed[0]->payment_image);
        }
        $mes['mes']='Thêm hình ảnh thành công';
        $mes['data'] = DB::table('tbl_billing_billing')->where('id',$request->id_billing)->get();
        return json_encode($mes); 
    }
    public function update_billing_quanlity(Request $request)
    {
        $service = DB::table('tbl_service_service')->where('id',$request->id_service)->get();
        $data = array();
        $data['billing_quantity']= $request->billing_quantity;
        $data['billing_price']=$service[0]->price * $request->billing_quantity;
        DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
        ->where('id_service',$request->id_service)->update($data);
      

        //// total_billing //////////////////////
        $total_actually = DB::table('tbl_billing_actually')->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_actually")])
        ->groupBy('id_billing')->get()->toArray(); //total_actually
        if(empty($total_actually))
        {
        $total_service= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
        $total_billing =$data[0]->total_service ;
        }else{
        $total_service= DB::table('tbl_billing_detail')    
        ->where('id_billing',$request->id_billing)
        ->select([DB::raw("SUM(billing_price) as total_service")])->groupBy('id_billing')->get();
        $total_billing = $total_actually[0]->total_actually + $total_service[0]->total_service ; 
        }
        ///////////////////////////////////////////////////////////////////////
        
        $data['total_biliing']=$total_billing;
        $data['total']=$total_actually[0]->total_actually;
        
        return json_encode($data);
    }

}
