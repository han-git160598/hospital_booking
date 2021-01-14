<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public function save_news(Request $request)
    {
        
        
        // $validation = Validator::make($request->all(), [
        //     'img_news' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);
        $check = DB::table('tbl_news')->where('title',$request->name_news)->get();
        if(count($check) > 0 )
        {
        $mes['mes']='Tiêu đề bài viết đã tồn tại';
        $mes['data']= 'faild';
        return json_encode($mes); 
        }
        if($request->content_news ==''|| $request->name_news =='' )
        {
        $mes['mes']='Vui lòng điền đầy đủ thông tin';
        $mes['data']= 'faild';
        return json_encode($mes);    
        }
        $image = $request->file('img_news');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/slide/'), $new_name);
        $url='images/slide/'.$new_name;
        $data = array();
        $data['home_action']='N';
        $data['content']=$request->content_news;
        $data['title']=$request->name_news;
        $data['image_upload']=$url;
        DB::table('tbl_news')->insert($data);
        $mes['mes']='Thêm bài viết thành công';
        $mes['data']= DB::table('tbl_news')->orderby('id','desc')->get();
        return json_encode($mes); 
    }
    public function delete_news($id)
    {
        DB::table('tbl_news')->where('id',$id)->delete();
        $data = DB::table('tbl_news')->orderby('id','desc')->get();
        return json_encode($data);
    } 
    public function edit_news(Request $request)
    {
        $data = DB::table('tbl_news')->where('id',$request->id)->get();
        return json_encode($data);
    }
    public function update_news(Request $request)
    {
        $check = DB::table('tbl_news')->where('id',$request->id_news)->get();
        $data = array();
        $mes=array();
        $image = $request->file('img_news_ud');
        if($request->file('img_news_ud')==null)
        {
        
        $data['title']=$request->name_news_ud;
        $data['content']=$request->content_news_ud;
        $data['home_action']='Y';
        DB::table('tbl_news')->where('id',$request->id_news)->update($data);
        $mes['mes']='Cập nhật bài viết thành công';
        $mes['data'] = DB::table('tbl_news')->where('id',$request->id_news)->get();
        return json_encode($mes);   
        }
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/slide/'), $new_name);
        $url='images/slide/'.$new_name;


        $data['image_upload']=$url;
        $data['title']=$request->name_news_ud;
        $data['content']=$request->content_news_ud;
        $data['home_action']='Y';
        DB::table('tbl_news')->where('id',$request->id_news)->update($data);
        $mes['mes']='Cập nhật bài viết thành công';
        $mes['data'] = DB::table('tbl_news')->where('id',$request->id_news)->get();
        return json_encode($mes);
    }
    public function disable_news($id)
    {
        $data = array();
        $data['home_action']='N';
        DB::table('tbl_news')->where('id',$id)->update($data);
        $alldata= DB::table('tbl_news')->orderby('id','desc')->get();
        return json_encode($alldata);
    }
    public function enable_news($id)
    {
        $data = array();
        $data['home_action']='Y';
        DB::table('tbl_news')->where('id',$id)->update($data);
        $alldata= DB::table('tbl_news')->orderby('id','desc')->get();
        return json_encode($alldata);
    }
    public function search_news(Request $request)
    {
        $keywork = $request->result;
        if($keywork =='')
        {
            $data = DB::table('tbl_news')->orderby('id','desc')->get();
            return json_encode($data);
        }else{
            $data = DB::table('tbl_news')->where('title', 'LIKE', "%{$keywork}%")->get();
            return json_encode($data);
        }   
    }
}
