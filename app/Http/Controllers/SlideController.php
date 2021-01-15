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
      $img= $request->file('img_slide');  
      if($request->stt_slide =='' || !isset($img))
        {
        $mes['mes']='Vui lòng điền đủ trường!';
        $mes['data']='faild';
        return json_encode($mes);    
        }
      $checkt =  DB::table('tbl_slide')->where('order_slide',$request->stt_slide)->get();
      if(count($checkt)>0)
      {
        $mes['mes']='Số thứ tự đã tồn tại';
        $mes['data']='faild';
        return json_encode($mes);     
      } 
        $validation = Validator::make($request->all(), [
        'img_slide' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $image = $request->file('img_slide');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/slide/'), $new_name);
        $url='images/slide/'.$new_name;

        $data['order_slide']=$request->stt_slide;
        $data['image_upload']=$url;
        DB::table('tbl_slide')->insert($data);
        $mes['mes']='Thêm slide hành công';
        $mes['data']= DB::table('tbl_slide')->orderby('id','desc')->get();
        return json_encode($mes); 

        
    }
    public function edit_slide(Request $request)
    {
        $data = DB::table('tbl_slide')->where('id',$request->id)->get();
        return json_encode($data);
    }
    public function update_slide(Request $request)
    {
      $slide = DB::table('tbl_slide') ->where('id',$request->id)->get();
      $image = $request->file('img_slide_ud');
      if($request->stt_slide_ud =='' || !isset($image))
        {
        $mes['mes']='Vui lòng điền đủ trường!';
        $mes['data']='faild';
        return json_encode($mes);    
        }
      // $checkt =  DB::table('tbl_slide')
      // ->whereNotIn('order_slide',$slide[0]->order_slide)
      // ->get();
      // if(count($checkt) > 0 )
      // {
      //   $mes['mes']='Số thứ tự đã tồn tại';
      //   $mes['data']='faild';
      //   return json_encode($mes);     
      // } 
        // $validation = Validator::make($request->all(), [
        // 'img_slide_ud' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);
        
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/slide/'), $new_name);
        $url='images/slide/'.$new_name;

        $data['order_slide']=$request->stt_slide_ud;
        $data['image_upload']=$url;
        DB::table('tbl_slide')->where('id',$request->id_slide)->update($data);
        $mes['mes']='Cập nhật Slide thành công';
        $mes['data']= DB::table('tbl_slide')->orderby('id','desc')->get();
        return json_encode($mes); 
    }
    public function delete_slide($id)
    {
        $a= DB::table('tbl_slide')->where('id',$id)->delete();
        $data = DB::table('tbl_slide')->orderby('id','desc')->get();
        return json_encode($data);
    }
}
