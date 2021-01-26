<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\AuthModel;
class AccountAdminController extends Controller  
{
    public function all_account_admin()
    {
    $model = new AuthModel;
    $model->AuthLogin();
    $permission=$model->permission();
    $data = DB::table('tbl_account_admin') 
    ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
    ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')
    ->orderby('tbl_account_admin.id','desc')->get(); 
    //dd($data); 
    return view('admin.account_admin',compact('data','permission'));
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
                ->select('tbl_account_admin.id','email','full_name','phone_number','type_account','username','description','status')
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
        $arraypermission=isset($request->arr)?$request->arr:array();
        
        foreach ($arraypermission as $v)
        {
            $check =  DB::table('tbl_account_authorize')
            ->where('id_admin',$request->id)
            ->where('grant_permission',$v)->get();
        
            if(count($check) == 0)
            {
             
                $data=array();
                $data['id_admin']=$request->id;
                $data['grant_permission']=$v;
                // $data['created_at']=date("Y-m-d H:i:s");
                // $data['updated_at']=date("Y-m-d H:i:s");
                DB::table('tbl_account_authorize')->insert($data);
               
            }
        }
        $alldata=DB::table('tbl_account_permission')
        ->join('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
        ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
        ->where('tbl_account_admin.id',$request->id)
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
        $mes['mes']='Vui lòng không để trống !';
        return json_encode($mes);    
        }
        if(strlen($request->pass_admin) < 6)
        {
        $mes['mes']='Mật khẩu phải tối thiểu 6 kí tự ';
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
        $permission = array(
            '0'=>DB::table('tbl_account_permission')->get()->toArray());
        $data = DB::table('tbl_account_type')->get()->toArray();
        array_push($permission,$data);

        return json_encode($permission);
    }
    public function save_account_admin(Request $request)
    {  
        $check_user= DB::table('tbl_account_admin')->where('username',$request->username)->count();
        $check_phone= DB::table('tbl_account_admin')->where('phone_number',$request->phone_number)->count();
        if($check_user > 0 || $check_phone > 0)
        {
        $mes['mes']='Tài khoản hoặc số điện thoại đã được đăng ký !';
        return json_encode($mes);    
        }
        $per = $request->arr_per1;
        if(empty($per))
        {
        $mes['mes']='Bạn chưa phân quyền !';
        return json_encode($mes);   
        }else{
        $data = array();
        $data['full_name']= $request->full_name;
        $data['username']= $request->username;
        $data['email']= $request->email;
        $data['id_type']= $request->account_type;
        $data['password']= md5($request->password_admin);
        $data['phone_number']=$request->phone_number;
        // $data['status']='Y';
        // $data['force_sign_out']='0';	
        DB::table('tbl_account_admin')->insert($data);
        $id_admin= DB::table('tbl_account_admin')->orderby('id','desc')->get();
        $id_admin[0]->id;
        foreach($per as $v)
        {
        $authorize = array();
        $authorize['id_admin']=$id_admin[0]->id;
        $authorize['grant_permission']=$v;
        DB::table('tbl_account_authorize')->insert($authorize);
        }
        $mes['mes']='Tạo tài khoản thành công !';
        return json_encode($mes);}
    }
    public function delete_account_admin(Request $request)
    {
        DB::table('tbl_account_authorize')->where('id_admin',$request->id)->delete();
        DB::table('tbl_account_admin')->where('id',$request->id)->delete();
        $data = DB::table('tbl_account_admin') 
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')
        ->orderby('tbl_account_admin.id','desc')
        ->get(); 
        return json_encode($data);
    }
    public function update_account_admin(Request $request)
    {
        // $id = [];
        // array_push($id,$request->id);
        // $check = DB::table('tbl_account_admin')
        // ->where('username',$request->username)
        // ->whereNotIn('id',$id)
        // ->get();
        // if(count($check) > 0)
        // {
        //     $mes['mes']='Tên đăng nhập đã tồn tại';
        //     return json_encode($mes); 
        // }
        if($request->account_type==0)
        {
        $data = array();
        $data['full_name']= $request->full_name;
        $data['username']= $request->username;
        $data['email']= $request->email;
        $data['phone_number']=$request->phone_number;	
        DB::table('tbl_account_admin')->where('id',$request->id)->update($data);
        $mes['mes']='Cập nhật trạng thái thành công !';
        return json_encode($mes);
        }else{
        $data = array();
        $data['full_name']= $request->full_name;
        $data['username']= $request->username;
        $data['email']= $request->email;
        $data['id_type']= $request->account_type;
        $data['phone_number']=$request->phone_number;
    //    $data['status']='Y';
    //    $data['force_sign_out']='0';	
        DB::table('tbl_account_admin')->where('id',$request->id)->update($data);
        $mes['mes']='Cập nhật trạng thái thành công !';
        return json_encode($mes);
        }
    }
    public function search_account_admin(Request $request)
    {
        $keywork = $request->result;
       
        if($keywork =='')
        {
            $data = DB::table('tbl_account_admin')->orderby('id','desc')
            ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
            ->select('tbl_account_admin.id', 'full_name', 'phone_number','status','type_account')
            ->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_account_admin')
            ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
            ->where('full_name', 'LIKE', "%{$keywork}%")
            ->orWhere('phone_number', 'LIKE', "%{$keywork}%")
            ->orWhere('type_account', 'LIKE', "%{$keywork}%")
            ->select('tbl_account_admin.id', 'full_name', 'phone_number', 'status','type_account')
            ->get();
            return json_encode($data);
        }

    }
    public function change_password_admin(Request $request)
    {
        $data= array();
        $check = DB::table('tbl_account_admin')->where('id',$request->id_admin)->where('password',md5($request->old_password))->get();
        $count = count($check);
        $min = $request->new_password;
      //  if($request->)
        if($count > 0 )
        {
            $data['password']=md5($request->new_password);
            DB::table('tbl_account_admin')->where('id',$request->id_admin)->update($data);
            $mes['mes']='Thay đổi mật khẩu thành công';
            return json_encode($mes);
        }else{
            $mes['mes']='Mật khẩu cũ không chính xác';
            return json_encode($mes);
        }
    }
}