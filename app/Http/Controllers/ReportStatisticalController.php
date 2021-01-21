<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\AuthModel;

class ReportStatisticalController extends Controller
{
    //báo cáo thống kê theo lịch khám
    public function statistical_examination_schedule(Request $request)
    {
        $year = $request->year_statistical; 
        $total_moth= array();
        for($i = 1; $i<=12;$i++)
        {
            if($i < 10)
            {
                $i = "0".$i;
            }
            $data_billing = DB::table('tbl_billing_billing')
            ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->select([DB::raw("SUM(tbl_billing_detail.billing_price) as total_billing")])
            ->groupBy('tbl_billing_detail.id_billing')
            ->get();
            //actually
            $data_actually = DB::table('tbl_billing_billing')
            ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->select([DB::raw("SUM(tbl_billing_actually.billing_price) as total_billing_actually")])
            ->groupBy('tbl_billing_actually.id_billing')
            ->get();

            $total_moth_actually = 0;
            if(isset($data_actually) && !empty($data_actually))
            {
                foreach($data_actually as $v)
                {
                    $total_moth_actually+=$v->total_billing_actually;
                    
                }
            }
           
            $total_moth_billing = 0;
            foreach($data_billing as $v)
            {
                $total_moth_billing+=$v->total_billing;
                
            }
            $total_moth_price = $total_moth_actually + $total_moth_billing;
            array_push($total_moth,["moth"=>$i,"total_moth"=>$total_moth_price]);
        }
        $data_total['total_moth']=$total_moth;
        return json_encode($data_total);
    }
    public function fillter_total_examination_schedule(Request $request) // lọc tổng doanh thu lịch khám 
    {
        $from_date = $request->from_date; 
        $to_date = $request->to_date; 
        $total_billing = DB::table('tbl_billing_billing')
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->whereBetween('billing_date', [$from_date."-01", $to_date."-31"])
        ->sum('billing_price');
        $total_actually = DB::table('tbl_billing_billing')
        ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->whereBetween('billing_date', [$from_date."-01", $to_date."-31"])
        ->sum('billing_price');
        $total_price = $total_billing + $total_actually;
        return json_encode($total_price);
    }

    // báo cáo thống kê theo dịch vụ
    public function statistical_service(Request $request) // thống kê doanh thu trong 1 năm
    {
        $year = $request->year_statistical; 
        $total_moth = array();
        for($i = 1; $i<=12;$i++)
        {
            if($i < 10)
            {
                $i = "0".$i;
            }
            $data_billing = DB::table('tbl_billing_detail')
            ->join('tbl_billing_billing','tbl_billing_billing.id','=','tbl_billing_detail.id_billing')
            ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_detail.id_service')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->where('tbl_billing_detail.id_service',$request->id_service)
            ->sum('tbl_billing_detail.billing_price');
            $total_billing=0;
            $total_billing += $data_billing;
           // actually
            $data_actually = DB::table('tbl_billing_billing')
            ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
            ->join('tbl_service_service','tbl_service_service.id','=','tbl_billing_actually.id_service')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_actually.id_service',$request->id_service)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->sum('billing_price');
            $total_actually=0;
            $total_actually += $data_actually;

            $total_moth_price = $total_actually + $total_billing;
            array_push($total_moth,["moth"=>$i,"total_moth"=>$total_moth_price]);
        }
    //    return json_encode($data_billing);
        $data_total['total_moth']=$total_moth;
        return json_encode($data_total);

    }
    public function fillter_total_service(Request $request) // tổng doanh thu trong khoảng time
    {
        $from_date = $request->from_date; 
        $to_date = $request->to_date; 
        $total_billing = DB::table('tbl_billing_billing')
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->where('tbl_billing_detail.id_service',$request->id_service)
        ->whereBetween('billing_date', [$from_date."-01", $to_date."-31"])
        ->sum('billing_price');
        $total_actually = DB::table('tbl_billing_billing')
        ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->where('tbl_billing_actually.id_service',$request->id_service)
        ->whereBetween('billing_date', [$from_date."-01", $to_date."-31"])
        ->sum('billing_price');
        $total_price = $total_billing + $total_actually;
        return json_encode($total_price);
    }

    // báo cáo thống kê theo khách hàng
    public function statistical_customer(Request $request) // thống kê doanh thu trong 1 năm
    {
        $total_billing = DB::table('tbl_billing_billing')
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->where('tbl_billing_billing.id_customer',27) 
        ->sum('billing_price');
        $total_actually = DB::table('tbl_billing_billing')
        ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->where('tbl_billing_billing.id_customer',27)
        ->sum('billing_price');
        $total_price = $total_billing + $total_actually;

        return json_encode($total_price);

    }
    public function fillter_total_customer(Request $request) // tổng doanh thu trong khoảng time
    {

    }

}
