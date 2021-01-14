<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AuthModel;
class AccountPermissionController extends Controller
{
    public function all_account_permission()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
        $all_account_premission = DB::table('tbl_account_permission')->orderby('id','desc')->get();
       // dd($all_account_premission);
        return view('admin.account_premission',compact('all_account_premission','permission'));
    }
    public function save_account_permission(Request $request)
    {
        if($request->permission =='' || $request->description=='')
        {
        $mes['mes']='Vui lòng điền đủ trường!';
        return json_encode($mes);    
        }
        $check= DB::table('tbl_account_permission')->where('permission',$request->permission)->count();
        if($check>0)
        {
        $mes['mes']='Trường này đã có';
        return json_encode($mes);      
        }
        $data = array();
        $data['permission']=$request->permission;
        $data['description']=$request->description;
        DB::table('tbl_account_permission')->insert($data);
        $mes['mes']='Thêm thành công!';
        return json_encode($mes);
    }
    public function edit_account_permission($id)
    {
        $data = DB::table('tbl_account_permission')->where('id',$id)->get();
        return json_encode($data);
    }
    public function update_account_permission(Request $request ,$id)
    {
        if($request->description=='')
        {
        $mes['mes']='Vui lòng điền đủ trường!';
        return json_encode($mes);    
        }
        $check= DB::table('tbl_account_permission')->where('permission',$request->permission)->count();
        if($check>0)
        {
        $mes['mes']='Trường này đã có';
        return json_encode($mes);      
        }
        $data = array();
       // $data['permission']=$request->permission;
        $data['description']=$request->description;
        DB::table('tbl_account_permission')->where('id',$id)->update($data);
        $mes['mes']='Cập nhật thành công!';
        return json_encode($mes);   
    }
    public function delete_account_permission($id)
    {
        DB::table('tbl_account_permission')->where('id',$id)->delete();
        $data = DB::table('tbl_account_permission')->orderby('id','desc')->get();
       // dd($data);
        return json_encode($data);

    }
    public function search_account_permission(Request $request)
    {
        $keywork = $request->result;
        if($keywork =='')
        {
            $data = DB::table('tbl_account_permission')->orderby('id','desc')->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_account_permission')->where('permission', 'LIKE', "%{$keywork}%")
            ->orWhere('description', 'LIKE', "%{$keywork}%")
            ->get();
            return json_encode($data);
        }

    }
}   
