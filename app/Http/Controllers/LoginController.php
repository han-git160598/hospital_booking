<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{

    public function login_admin(Request $request)
    {
        
    	$username = $request->username;
    	$password=md5($request->password);
    	$result = DB::table('tbl_account_admin')->where('username',$username)->where('password',$password)->first();
       // dd($result);
    	if($result && $result->status == 'Y')
    	{
            $data = array();
            $data['force_sign_out']='0';
            DB::table('tbl_account_admin')->where('id',$result->id)->update($data);
    		Session::put('full_name',$result->full_name);
            Session::put('email',$result->email);
            Session::put('id',$result->id);
    		return Redirect::to('/dashboard');
           //return Redirect()->back();
    	}else{
    		Session::put('message','Mật khẩu hoặc tài khoản không chính xác!!! Vui lòng nhập lại ');
    		return Redirect::to('/');
    	}
    }
    public function logout_admin()
    {
        $id = Session::get('id');
        $data = array();
        $data['force_sign_out']='1';
        DB::table('tbl_account_admin')->where('id',$id)->update($data);
        Session::put('full_name',null);
        Session::put('email',null);
        Session::put('id',null);
    	return view('login');
    }
    // public function permission()
    // {
    //     $id = Session::get('id');
    //     $permission=DB::table('tbl_account_permission')
    //     ->leftjoin('tbl_account_authorize','tbl_account_authorize.grant_permission','=','tbl_account_permission.id')
    //     ->leftjoin('tbl_account_admin','tbl_account_admin.id','=','tbl_account_authorize.id_admin')
    //     ->where('tbl_account_authorize.id_admin',$id)
    //    // ->select('tbl_account_permission.id','description', 'tbl_account_authorize.admin')
    //     ->get();
        

    // }
}
