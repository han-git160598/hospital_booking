<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use DB;
class AccountTypeController extends Controller
{
    public function all_account_type()
    {
        $all_account_type=DB::table('tbl_account_type')->orderby('id','desc')->get();
        return view('admin.account_type',compact('all_account_type'));
    }
    public function save_account_type(Request $request)
    {
        if($request->type_account=='' || $request->description=='')
        {
        $mes['mes']='Vui lòng điền đủ thông tin!';
        return json_encode($mes);    
        }
        $check=DB::table('tbl_account_type')->where('type_account',$request->type_account)->count();
        if($check>0)
        {
        $mes['mes']='Loại tài khoản đã tồn tại!';
        return json_encode($mes);     
        }
        $data = array();
        $data['type_account']=$request->type_account;
        $data['description']=$request->description;
        DB::table('tbl_account_type')->insert($data);
        $mes['mes']='Thêm thành công!';
        return json_encode($mes);    
    }
    public function delete_account_type($id)
    {
        DB::table('tbl_account_type')->where('id',$id)->delete();
        $data=DB::table('tbl_account_type')->orderby('id','desc')->get();
        return json_encode($data);
    }
    public function edit_account_type($id)
    {
        $data =  DB::table('tbl_account_type')->where('id',$id)->get();
        return json_encode($data);
    }
    public function update_account_type(Request $request, $id)
    {
        if($request->type_account=='' || $request->description=='')
        {
        $mes['mes']='Vui lòng điền đủ thông tin!';
        return json_encode($mes);    
        }
        $check=DB::table('tbl_account_type')->where('type_account',$request->type_account)->count();
        if($check>0)
        {
        $mes['mes']='Loại tài khoản đã tồn tại!';
        return json_encode($mes);     
        }
        $data = array();
        $data['type_account']= $request->type_account;
        $data['description']= $request->description;
        DB::table('tbl_account_type')->where('id',$id)->update($data);
        $mes['mes']='Cập nhật thành công!';
        return json_encode($mes); 
    }
}
