<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AuthModel;
use Validator;
class SlideController extends Controller
{
    public function all_slide()
    {
        $model = new AuthModel;
        $model->AuthLogin();
        $permission=$model->permission();
        $all_slide=DB::table('tbl_slide')->orderby('id','desc')->get();
        return view('admin.slide',compact('all_slide','permission'));
    }
    public function save_slide(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image_upload_slide' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
           ]);
       
           if($validation->passes())
           {
            $image = $request->file('image_upload_slide');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/img'), $new_name);
            $mes['mes']='Thêm sdsds thành công!';
            return json_encode($mes); 
           }
        // if($request->order_slide =='' )
        // {
        // $mes['mes']='Vui lòng điền đủ trường!';
        // return json_encode($mes);    
        // }
        // $checkslide= DB::table('tbl_slide')->where('order_slide',$request->order_slide)->count();
        // if($checkslide>0)
        // {
        // $mes['mes']='Trường này đã có';
        // return json_encode($mes);      
        // }

        
        
      

        // $data['order_slide']=$request->order_slide;
        // $data['image_upload']=$new_name;
        // DB::table('tbl_slide')->insert($data);
         $mes['mes']='Thêm thành công!';
         return json_encode($mes); 

        
    }
    public function delete_slide($id)
    {
        $a= DB::table('tbl_slide')->where('id',$id)->delete();
        $data = DB::table('tbl_slide')->orderby('id','desc')->get();
        return json_encode($data);
    }
    public function edit_slide($id)
    {
        $data = DB::table('tbl_slide')->where('id',$id)->get();
        return json_encode($data);
    }
    public function update_slide(Request $request,$id)
    {
        if($request->order_slide =='' || $request->image_upload_slide=='')
        {
        $mes['mes']='Vui lòng điền đủ trường!';
        return json_encode($mes);    
        }
        $checkslide= DB::table('tbl_slide')->where('order_slide',$request->order_slide)->count();
        if($checkslide>0)
        {
        $mes['mes']='Trường này đã có';
        return json_encode($mes);      
        }
        $data= array();
        $data['order_slide']=$request->order_slide;
        $data['image_upload']=$request->image_upload_slide;
        DB::table('tbl_slide')->where('id',$id)->update($data);
        $mes['mes']='Cập nhật thành công!';
        return json_encode($mes);
    }
}
