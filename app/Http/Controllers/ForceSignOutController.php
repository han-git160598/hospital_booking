<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\AuthModel;
class ForceSignOutController extends Controller
{
    public function force_sign_out_staff()
    {
        $id = array(Session::get('id'));
        $data = array();
        $data['force_sign_out']='0';
        DB::table('tbl_account_admin')->WhereNotIn('id',$id)->update($data);
        $mes['mes']='Cưỡng chế thành công!';
        return json_encode($mes);
    }
    public function force_sign_out_customer()
    {
        $id = Session::get('id');
        $data = array();
        $data['force_sign_out']='0';
        DB::table('tbl_account_customer')->update($data);
        $mes['mes']='Cưỡng chế thành công!';
        return json_encode($mes);
    }
}
