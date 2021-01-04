<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;
class AuthModel extends Model
{
    public function AuthLogin(){
        $id_admin = Session::get('id');
        $force = DB::table('tbl_account_admin')->where('id',$id_admin)->get();
        if($id_admin && $force[0]->force_sign_out == '1'){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/login-admin')->send();
        }
    }
    public function Admin()
    {
        $id = Session::get('id');
        $permission = DB::table('tbl_account_admin')
        ->join('tbl_account_type','tbl_account_type.id','=','tbl_account_admin.id_type')
        ->where('tbl_account_admin.id',$id)
        ->select('tbl_account_admin.id','type_account')
        ->get();
        if($permission[0]->type_account == 'Admin')
        {
            return view('admin.force_sign_out');
        }else{
            $mes['mes']='Bạn không có quyền nè!';
            return Redirect::to('/dashboard');
        }   
    }
}
