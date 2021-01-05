<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AuthModel;
class ServicePacketController extends Controller
{
    public function all_service_packet()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
        $all_service_packet_detail= DB::table('tbl_service_packet_detail')
        ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')
        ->where('status_service','Y')->get();
        $all_service_packet = DB::table('tbl_service_packet')->get();  
        $tam=array();

        foreach($all_service_packet as $packet)
        {
            $sum = 0;
            foreach($all_service_packet_detail as $detail)
            {
                if($packet->id == $detail->id_service_packet)
                {
                   $sum +=$detail->price;
                  
                }
                
            }
            array_push($tam,["id"=>$packet->id,"name"=>$packet->packet_service,"total"=>$sum]);
            

        }
        
          // echo $tam[0]['name'];
        
                            // echo ("<pre>");
                            // print_r($tam);
                            // echo ("</pre>");
       //dd($tam);
        return view('admin.service_packet',compact('tam','permission'));
    }
    public function list_service_packet_detail(Request $request) // edit service packet
    {
       $data= DB::table('tbl_service_packet_detail')
        ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_service')
        ->leftjoin('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->where('status_service','Y')
        ->where('tbl_service_packet_detail.id_service_packet',$request->id)->get();
        return json_encode($data);
    }
    public function listservice_service()
    {

        $stt ='Y';
        $data= DB::table('tbl_service_service')
         ->where('status_service',$stt)->get();
        return json_encode($data);
    }
    public function select_list(Request $request)
    {
        
        $data=DB::table('tbl_service_service')
        ->where('id',$request->idservice)->get();
       // dd($data);
        return json_encode($data);
    }
    public function save_service_packet(Request $request)
    {
        if($request->packet_service =='' || $request->packet_content =='')
        {
        $mes['mes']='Vui lòng điền đủ';
        return json_encode($mes);
        }
        $kt = DB::table('tbl_service_packet')->where('packet_service',$request->packet_service)->count();
        if($kt>0)
        {
        $mes['mes']='Goi dịch vụ đã tồn tại';
        return json_encode($mes);   
        }
        if(isset($request->arr1))
        {
            $data = array();
            $data['packet_service']=$request->packet_service; 
            $data['packet_content']=$request->packet_content;
            DB::table('tbl_service_packet')->insert($data);
            $id = DB::table('tbl_service_packet')->orderby('id', 'desc')->first();

            $arrayservice=isset($request->arr1)?$request->arr1:array();
            $arr=array();
            $x=count($arrayservice);
            if($x==0)
            {
            $mes['mes']='Vui chon dich vu';
            return json_encode($mes);
            }
            else
            {
                foreach($arrayservice as  $k => $v) 
                {       
                    $arr['id_service_service']=$v;
                    $arr['id_service_packet']=$id->id;
                    DB::table('tbl_service_packet_detail')->insert($arr); 
                }
               
            }
            $mes['mes']='Thanh cong';
            return json_encode($mes);
        }else{
            $mes['mes']='Vui chon dich vu';
            return json_encode($mes);}
    }
    public function edit_service_packet($id)
    {

    $data= DB::table('tbl_service_packet')->where('id',$id)->get();

    $data['service'] =DB::table('tbl_service_packet_detail')
    ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
    ->join('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')
    ->where('status_service','Y')
    ->where('tbl_service_packet_detail.id_service_packet',$id)
    
    ->select('tbl_service_packet_detail.id_service_service','service', 'price')
    ->get();
  //  array_push($data,$service_packet);
    return json_encode($data);     
    }
    public function delete_service_packet(Request $request)
    {
       $count= DB::table('tbl_service_packet_detail')->where('id_service_packet',$request->id)->count();
       if($count > 0)
       {
         DB::table('tbl_service_packet_detail')->where('id_service_packet',$request->id)->delete();
       }
         DB::table('tbl_service_packet')->where('id',$request->id)->delete();

         $all_service_packet_detail= DB::table('tbl_service_packet_detail')
        ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->join('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')->get();
        $all_service_packet = DB::table('tbl_service_packet')->get();  
        $tam=array();

        foreach($all_service_packet as $packet)
        {
            $sum = 0;
            foreach($all_service_packet_detail as $detail)
            {
                if($packet->id == $detail->id_service_packet)
                {
                   $sum +=$detail->price;
                  
                }
                
            }
            array_push($tam,["id"=>$packet->id,"name"=>$packet->packet_service,"total"=>$sum]);
            

        }
        return json_encode($tam);
    }
    public function remove_service_packet_detail(Request $request)// xóa detail
    {
        DB::table('tbl_service_packet_detail')
        ->where('id_service_packet',$request->id_packet)
        ->where('id_service_service',$request->id_ser)->delete();  

        $data= DB::table('tbl_service_packet_detail')
        ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_service')
        ->leftjoin('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->where('tbl_service_packet_detail.id_service_packet',$request->id_packet)
        ->where('status_service','Y')
        ->select('tbl_service_packet_detail.id_service_packet', 'service', 'price','tbl_service_packet_detail.id_service_service')
        ->get();
     
        return json_encode($data);

    }
    public function list_service_in_packet(Request $request)
    {
        $id_packet = $request->id_packet;
        $array_service = array();
        $detail = DB::table('tbl_service_packet_detail')->where('id_service_packet',$id_packet)->get();
        foreach($detail as $v)
        {
            array_push($array_service,$v->id_service_service);
        }
        $data = DB::table('tbl_service_service')->where('status_service','Y')->WhereNotIn('id',$array_service)->get();
        return json_encode($data);
    }
    public function update_service_packet_detail(Request $request)
    {
        $array_service = $request->arr_service;
        $data=array();
        foreach ($array_service as $v)
        {
        $data['id_service_packet']=$request->id_packet; 
        $data['id_service_service']=$v;
        DB::table('tbl_service_packet_detail')->insert($data); 
        }
        $list_service= DB::table('tbl_service_packet_detail')
        ->leftjoin('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_service')
        ->leftjoin('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->where('status_service','Y')
        ->where('tbl_service_packet_detail.id_service_packet',$request->id_packet)->get();
        return json_encode($list_service);
    }
    public function update_service_packet(Request $request)
    {
        if($request->packet_service =='' || $request->packet_content =='')
        {
        $mes['mes']='Vui lòng điền đủ';
        return json_encode($mes);
        }
        // $kt = DB::table('tbl_service_packet')
        // ->where('packet_service',$request->packet_service)
        // ->WhereNotIn('id',$request->id)
        // ->get();
        // if(!empty($kt))
        // {
        // $mes['mes']='Tên này đã có';
        // return json_encode($kt);   
        // }
        $data = array();
        $data['packet_service']=$request->packet_service; 
        $data['packet_content']=$request->packet_content;
        DB::table('tbl_service_packet')->where('id',$request->id)->update($data);
        $mes['mes']='Cập nhật thành công';
        return json_encode($mes);

    }
}
