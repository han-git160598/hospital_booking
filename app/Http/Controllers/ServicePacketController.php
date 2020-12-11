<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ServicePacketController extends Controller
{
    public function all_service_packet()
    {
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
        
          // echo $tam[0]['name'];
        
                            // echo ("<pre>");
                            // print_r($tam);
                            // echo ("</pre>");
       //dd($tam);
        return view('admin.service_packet',compact('tam'));
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
        $data= DB::table('tbl_service_packet_detail')
        ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        ->rightjoin('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')
        ->where('tbl_service_packet_detail.id_service_packet',$id)->get();
        return json_encode($data);     
    }
}
