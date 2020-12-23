<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AccountAdminController extends Controller  
{
    public function all_account_admin()
    {
    $data = DB::table('tbl_account_admin') 
    ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
    ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')
    ->get(); 
    //dd($data); 
    return view('admin.account_admin',compact('data'));
    }
    public function disable_account_admin($id)
    {
        $data = array();
        $data['status']='N';
        DB::table('tbl_account_admin')->where('id',$id)->update($data);
        $alldata= DB::table('tbl_account_admin')
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')->get();
        return json_encode($alldata);
    }
    public function enable_account_admin($id)
    {
        $data = array();
        $data['status']='Y';
        DB::table('tbl_account_admin')->where('id',$id)->update($data);
        $alldata= DB::table('tbl_account_admin')
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')->get();
        return json_encode($alldata);
    }
    public function account_admin_detail($id)
    {
        $data= DB::table('tbl_account_admin')->where('id',$id)->get();    
        return json_encode($data);
    }
    public function list_account_permission()
    {
        $data = DB::table('tbl_account_permission')->get();
        return json_encode($data);
    }
    public function save_account_authorize(Request $request)
    {
        $arraypermission=isset($request->arr1)?$request->arr1:array();
        $data=array();
        $alldata=DB::table('tbl_account_admin')
        ->join('tbl_account_authorize','tbl_account_authorize.id_admin','=','tbl_account_admin.id')
        ->join('tbl_account_permission','tbl_account_permission.id','=','tbl_account_authorize.grant_permission')
        ->where('tbl_account_admin.id',$request->id_acc_admin)->get();
        $flag = 0;
        foreach($alldata as $value) { 
            foreach($arraypermission as  $k => $v ) 
            {
                if($value->grant_permission == $v){
                    $flag ==1;
                }
                if($flag == 0)
                {
                    $data['id_admin']=$request->id_acc_admin;
                    $data['grant_permission']=$v;
                    DB::table('tbl_account_authorize')->insert($data); 
                }  
            }
        }
        return json_encode($alldata);
    }

}