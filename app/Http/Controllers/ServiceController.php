<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ServiceController extends Controller
{
    public function allservice_service()
    {
        $stt = 'Y';
        $allservice_service = DB::table('tbl_service_service')->where('status_service',$stt)->orderby('id','desc')->get();
       // dd($allservice_service);
       return view('admin.service_service',compact('allservice_service'));
        //return view('admin.service_service')->with('allservice_service',$allservice_service);
    }
    public function saveservice_service (Request $request)
    {   
        $kt = DB::table('tbl_service_service')->where('service',$request->service)->count();
        if($kt>0)
        {
        $mes['mes']='dịch vụ đã tồn tại';
        return json_encode($mes);   
        }
        $mes=array('mes'=>'kh');
        if($request->service =='' || $request->content =='' ||$request->price == '' )
        {
        $mes['mes']='Vui lòng điền đủ';
        return json_encode($mes);
        }
        $data= array();
        $data['service'] = $request->service;
        $data['content'] = $request->content;
        $data['price'] = $request->price;
        DB::table('tbl_service_service')->insert($data);
        $mes['mes']='Thêm thành công';
        return json_encode($mes);  
    }
    public function deleteservice_service($id)
    {
        DB::table('tbl_service_service')->where('id',$id)->delete();
        $data = DB::table('tbl_service_service')->orderby('id','desc')->get();
        return json_decode($data);
    }    
    public function editservice_service($id)
    {
        $data = DB::table('tbl_service_service')->where('id',$id)->get();
        //dd($data);
        return json_decode($data);    
    }
    public function updateservice_service(Request $request, $id)
    {
        $data = array();
        $data['service']= $request->service;
        $data['price']= $request->price;
        $data['content']= $request->content;
        DB::table('tbl_service_service')->where('id',$id)->update($data);
        $data= DB::table('tbl_service_service')->orderby('id','desc')->get();
        return json_decode($data);
    }
    public function searchservice_service($name)
    {
        $data = DB::table('tbl_service_service')->where('id',$name)->get();
        return json_encode($data);
    }
    public function disable_service($id)
    {
        $stt = 'Y';
        $data = array();
        $data['status_service']='N';
        DB::table('tbl_service_service')->where('id',$id)->update($data);
        $alldata = DB::table('tbl_service_service')->where('status_service',$stt)->orderby('id','desc')->get();
        return json_encode($alldata);
    }
    public function enable_service($id)
    {
        $stt = 'N';
        $data = array();
        $data['status_service']='Y';
        DB::table('tbl_service_service')->where('id',$id)->update($data);   
        $alldata = DB::table('tbl_service_service')->where('status_service',$stt)->orderby('id','desc')->get(); 
        return json_encode($alldata);
    }
    public function all_disable_service()
    {
        $stt = 'N';
        $disable_service = DB::table('tbl_service_service')->where('status_service',$stt)->orderby('id','desc')->get();
        return view('admin.disable_service',compact('disable_service'));
    }
    public function search_service_service(Request $request)
    {
        $keywork = $request->service;
        if($keywork =='')
        {
            $data = DB::table('tbl_service_service')->orderby('id','desc')->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_service_service')->where('service', 'LIKE', "%{$keywork}%")->get();
            return json_encode($data);
        }
      
    }
}
