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
    ->orderby('tbl_account_admin.id','desc')->get(); 
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
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')->orderby('tbl_account_admin.id','desc')->get();
        return json_encode($alldata);
    }
    public function enable_account_admin($id)
    {
        $data = array();
        $data['status']='Y';
        DB::table('tbl_account_admin')->where('id',$id)->update($data);
        $alldata= DB::table('tbl_account_admin')
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')->orderby('tbl_account_admin.id','desc')->get();
        return json_encode($alldata);
    }
    public function account_admin_detail($id)
    {   
        $permission_item = array( 
            '0'=>DB::table('tbl_account_admin')
                ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
                ->where('tbl_account_admin.id',$id)
                ->select('tbl_account_admin.id','email','full_name','phone_number','type_account','username','description')
                ->get()->toArray(),
        ); 
        $account_type = DB::table('tbl_account_type')->get();
        $permission=DB::table('tbl_account_permission')
        ->leftjoin('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_authorize.id_admin',$id)
        ->select('tbl_account_permission.id','description')
        ->get()->toArray();
        array_push($permission_item['0'],$permission,$account_type);
       
        return json_encode($permission_item);
    }
    public function list_account_permission(Request $request)
    {

        $arr =$request->arr_author1;

        if($arr == '')
        {
         $data = DB::table('tbl_account_permission')
        ->select('id','description')->get();
        return json_encode($data);   
        }
        $data = DB::table('tbl_account_permission')
       //->where('tbl_account_authorize.id_admin',$request->id)
        ->whereNotIn('tbl_account_permission.id',$arr)
        ->select('id','description')->get();
        return json_encode($data);
    }
    public function save_account_authorize(Request $request)
    {
        $arraypermission=isset($request->arr1)?$request->arr1:array();
        $data=array();
        $flag = 0;
        foreach ($arraypermission as $v)
        {
           $check =  DB::table('tbl_account_authorize')->where('id_admin',$request->id_acc_admin)
            ->where('grant_permission',$v)->count();
            if($check == 0)
            {
                $data['id_admin']=$request->id_acc_admin;
                $data['grant_permission']=$v;
                DB::table('tbl_account_authorize')->insert($data);        
            }
        }
         $alldata=DB::table('tbl_account_permission')
        ->join('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_admin.id',$request->id_acc_admin)
        ->select('tbl_account_permission.id','description','tbl_account_authorize.id_admin')
        ->get();
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
    public function remove_authorize_admin(Request $request)
    {
        DB::table('tbl_account_authorize')
        ->where('id_admin',$request->id_admin1)
        ->where('grant_permission',$request->id_pre1)->delete();

        $alldata=DB::table('tbl_account_permission')
        ->join('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_admin.id',$request->id_admin1)
        ->select('tbl_account_permission.id','description','tbl_account_authorize.id_admin')
        ->get();
        return json_encode($alldata);
    }
    public function list_account_type()
    {
        $data = DB::table('tbl_account_type')->get();
        return json_encode($data);
    }
    public function save_account_admin(Request $request)
    {  
    
        if($request->full_name == '')
        {
        $mes['mes']='Vui lòng điền đủ trường !';
        return json_encode($mes);
        }
        $data = array();
        $data['full_name']= $request->full_name;
        $data['username']= $request->username;
        $data['email']= $request->email;
        $data['id_type']= $request->account_type;
        $data['password']= $request->password_admin;
        $data['phone_number']=$request->phone_number;
        $data['status']='Y';
        $data['force_sign_out']='0';	
        DB::table('tbl_account_admin')->insert($data);
        $mes['mes']='Tạo tài khoản thành công !';
        return json_encode($mes);
    }
    public function delete_account_admin(Request $request)
    {
        DB::table('tbl_account_authorize')->where('id_admin',$request->id)->delete();
        DB::table('tbl_account_admin')->where('id',$request->id)->delete();
        $data = DB::table('tbl_account_admin') 
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')
        ->get(); 
        return json_encode($data);

    }
}