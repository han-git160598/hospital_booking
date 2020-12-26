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
        $admin['premission_ad']=DB::table('tbl_account_permission')
        ->leftjoin('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_admin.id',$id)
        ->select('tbl_account_permission.id','description')->get();
        $admin=DB::table('tbl_account_admin')->get();
        return json_encode($admin);
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
        $alldata=DB::table('tbl_account_permission')
        ->join('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_admin.id',$request->id_acc_admin)->select('tbl_account_permission.id','description')->get();
        $flag = 0;
        // foreach($arraypermission as $v ) {  3 4 5 6 
        //     foreach($alldata as $value)   3 4 5 6 7
        //     {
        //         if($value->id == $v){ 
        //             $flag ==1;
        //             break;
        //         }
        //         if($flag == 0)
        //         {
        //             $data['id_admin']=$request->id_acc_admin;
        //             $data['grant_permission']=$v;
        //             DB::table('tbl_account_authorize')->insert($data); 
        //         }  
        //     }
        // }
      
        return json_encode($alldata);
    }
    public function reset_password_admin(Request $request)
    {
        // $check_pass=DB::table('tbl_account_admin')->where('id',$request->id_admin)->get();
        // if($check_pass[0]->password != md5($request->pass_admin))
        // {
        // $mes['mes']='Mật khẩu không hợp lệ !';
        // return json_encode($mes);   
        // }
        if($request->pass_admin== '')
        {
        $mes['mes']='Vui lòng không để trông !';
        return json_encode($mes);    
        }
        $data= array();
        $data['password']=md5($request->pass_admin);
        DB::table('tbl_account_admin')->where('id',$request->id_admin)->update($data);
        $mes['mes']='Thay đổi mật khẩu thành công !';
        return json_encode($mes);     
    }

}