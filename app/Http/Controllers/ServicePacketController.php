<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ServicePacketController extends Controller
{
    public function all_service_packet()
    {
        //  $all_service_packet= DB::table('tbl_service_packet_detail')
        // ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
        //  ->join('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')->get();
        //dd($all_service_packet);
        $all_service_packet_detail= DB::table('tbl_service_packet_detail')
        ->join('tbl_service_packet','tbl_service_packet.id','=','tbl_service_packet_detail.id_service_packet')
         ->join('tbl_service_service','tbl_service_service.id','=','tbl_service_packet_detail.id_service_packet')->get();
        $all_service =DB::table('tbl_service_service')->get();
        $all_service_packet = DB::table('tbl_service_packet')->get();  
       
        //
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
            array_push($tam,["name"=>$packet->packet_service,"total"=>$sum]);
            

        }
        
          // echo $tam[0]['name'];
        
                            // echo ("<pre>");
                            // print_r($tam);
                            // echo ("</pre>");
       //dd($tam);
        return view('admin.service_packet',compact('tam'))
        ->with('all_service_packet',$all_service_packet);
    }
    public function listservice_service()
    {
        $data= DB::table('tbl_service_service')->get();
        return json_encode($data);
    }
    public function select_list(Request $request)
    {

        $data=DB::table('tbl_service_service')->where('id',$request->idservice)->get();
       // dd($data);
        return json_encode($data);
    }
}
